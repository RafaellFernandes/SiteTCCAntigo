<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
        exit;
    }

?>
<div class="container-fluid">
<br>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>      
        
     