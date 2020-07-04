<?php
namespace CSY2028;
interface Routes {
    public function getRoutes();
    public function getTemplateVariables();
    public function checkLogin();
    public function checkAccess();
}
?>