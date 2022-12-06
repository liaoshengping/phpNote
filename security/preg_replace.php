<?php
preg_replace("/\[（.*）\]/e", '\\1',$_GET['str']);