<?php

namespace Chatgptcontentgenerator\ProductReviews\Traits;

trait ConfigurationTrait
{
    /**
     * @return string
     */
    public function getReviewsConfigurationForm()
    {
        if ($this->isActive() == false) {
            return '';
        }

        $context = \Context::getContext();

        $helper = new \HelperForm();
        $helper->show_toolbar = false;
        $helper->table = 'gpt_configuration';
        $helper->default_form_language = (int) \Configuration::get('PS_LANG_DEFAULT');
        $helper->module = $this->module;
        $helper->allow_employee_form_lang = \Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG')
            ? \Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG')
            : 0;
        $helper->identifier = 'id_configuration';
        $helper->submit_action = 'submitReviewsConfigurations';
        $helper->currentIndex = $context->link->getAdminLink(
            'AdminModules',
            false,
            [],
            ['configure' => $this->module->name, 'tab_module' => $this->module->tab, 'module_name' => $this->module->name]
        );
        $helper->token = \Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => [
                $this->module->getConfigName('AUTHOR_NAME_FORMAT') => $this->module->getConfigGlobal('AUTHOR_NAME_FORMAT'),
            ],
            'languages' => $context->controller->getLanguages(),
            'id_language' => $context->language->id,
        ];

        return $helper->generateForm([
            [
                'form' => [
                    'legend' => [
                        'title' => $this->getTranslator()->trans('Reviews settings', [], 'Modules.Chatgptcontentgenerator.Admin'),
                        'icon' => 'icon-chat',
                    ],
                    'input' => [
                        [
                            'type' => 'select',
                            'label' => $this->getTranslator()->trans('Author name format', [], 'Modules.Chatgptcontentgenerator.Admin'),
                            'name' => $this->module->getConfigName('AUTHOR_NAME_FORMAT'),
                            'required' => false,
                            'options' => [
                                'query' => [
                                    [
                                        'id_option' => 1,
                                        'name' => 'John Doe',
                                    ],
                                    [
                                        'id_option' => 2,
                                        'name' => 'John D.',
                                    ],
                                    [
                                        'id_option' => 3,
                                        'name' => 'J. Doe',
                                    ],
                                ],
                                'id' => 'id_option',
                                'name' => 'name',
                            ],
                        ],
                    ],
                    'submit' => [
                        'title' => $this->getTranslator()->trans('Save', [], 'Admin.Global'),
                        'class' => 'btn btn-default pull-right',
                        'name' => 'submitReviewsConfigurations',
                    ],
                ],
            ]
        ]);
    }

    public function saveConfigurations(array &$confirmations)
    {
        if (\Tools::isSubmit('submitReviewsConfigurations')) {
            $this->module->setConfigGlobal('AUTHOR_NAME_FORMAT', (int) $this->module->getValue('AUTHOR_NAME_FORMAT'));

            $confirmations[] = $this->getTranslator()->trans('The settings has been updated successfully', [], 'Modules.Chatgptcontentgenerator.Admin');
        }
    }
}
