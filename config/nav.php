<?php 
return [
    [
        'route'=>'dashboard.dashboard' ,
        'icon'=>'nav-icon fas fa-th' ,
        'title'=> 'dashboard' ,
        'badge'=> 'new' ,
        'active'=> 'dashboard.dashboard'

    ] ,
    [
        'route'=>'dashboard.categories.index' ,
        'icon'=>'nav-icon fas fa-th' ,
        'title'=> 'Categories' ,
        'active'=> 'dashboard.categories.*'
 
    ] ,

    [
        'route'=>'dashboard.products.index' ,
        'icon'=>'nav-icon fas fa-th' ,
        'title'=> 'Products' ,
        'active'=> 'dashboard.products.*'
 
    ] ,
] ;