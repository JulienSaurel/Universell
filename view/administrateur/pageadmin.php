<?php

foreach ($tab_p as $p)
{
    $id = $p->get('id');
    $idP = htmlspecialchars($id);
    $idPUrl = rawurlencode($id);

    echo "<p> La planète  <a href=\"?action=read&controller=administrateur&type=Planetes&id={$idPUrl}\"> $id </a> . </p>";
}

foreach ($tab_c as $c)
{
    $id = $c->get('login');
    $id = htmlspecialchars($id);
    $idCUrl = rawurlencode($id);

    echo "<p> Client d'id  <a href=\"?action=read&controller=administrateur&type=Client&id={$idCUrl}\"> $id </a> . </p>";
}

 ?>