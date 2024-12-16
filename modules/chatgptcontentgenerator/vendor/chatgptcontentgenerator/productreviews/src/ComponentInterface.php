<?php

namespace Chatgptcontentgenerator\ProductReviews;

interface ComponentInterface
{
    public function getName();
    public function getTitle();
    public function getDescription();

    public function install();
    public function uninstall();

    public function enable();
    public function disable();
}
