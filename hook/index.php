<?php
include_once ('manager.php');

//������������
$manager = new PluginManager(); //�ɰ��������ϵͳ�ľ�̬�� eg:app('plugin')

$manager->trigger('order','����id:234234234');
