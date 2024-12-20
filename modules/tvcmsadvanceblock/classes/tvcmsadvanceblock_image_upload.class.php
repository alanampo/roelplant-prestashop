<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

// Image_upload class is use for image uploading
class TvcmsAdvanceBlockImageUpload extends Module
{
    public function imageUploading($image_src_1, $old_file)
    {
        $returnData = array();
        $errorMessage = "";
        $successUpload = false;
        $imgName = $image_src_1['name'];

        /************resize settings***************/
        // $savePath = _PS_BASE_URL_._MODULE_DIR_.'tvcmsmultibanner/views/img/';
        $savePath = _PS_MODULE_DIR_.'tvcmsadvanceblock/views/img/';

        $resultType = $this->imageConditions($image_src_1);
        if ($resultType) {
            $imgName = $image_src_1['name'];
            if (file_exists($savePath.$imgName)) {
                $new_img_name = explode(".", $imgName);
                $imgName = $new_img_name[0]."_".date("YmdHis").".".$new_img_name[1];
            }

            $save_destination = $savePath.$imgName;
            $resultUpload = move_uploaded_file($image_src_1['tmp_name'], $save_destination);

            if ($resultUpload) {//success
                $res = preg_match('/^demo_main_img.*$/', $old_file);
                $res2 = preg_match('/^demo_main_block_img.*$/', $old_file);
                $res3 = preg_match('/^demo_img_.*$/', $old_file);

                if (file_exists(dirname(__FILE__).'./../views/img/'.$old_file)
                    && $res != '1'
                    && $res2 != '1'
                    && $res3 != '1') {
                    unlink(dirname(__FILE__).'./../views/img/'.$old_file);
                }
                $successUpload = true;
            } else {
                $errorMessage .= $this->displayError($this->l("Image Upload Problem"));
            }
        } else {
            $errorMessage .= $this->displayError($this->l("Please Select Valid Image File."));
        }
        $returnData['error'] = $errorMessage;
        $returnData['success'] = $successUpload;
        $returnData['name'] = $imgName;

        return $returnData;
    }

    // Image_conditions
    public function imageConditions($image_src)
    {
        if ($image_src['type'] == "image/jpeg" ||
            $image_src['type'] == "image/jpg" ||
            $image_src['type'] == "image/png" ||
            $image_src['type'] == "image/gif") {
            return true;
        } else {
            return false;
        }
    }
}
