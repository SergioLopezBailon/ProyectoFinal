@extends('layouts.app',['pageSlug'=>'ruleta'])
<?php 
    function premio()
    {
        $premio = 180;
        return $premio ;
    }
?>


@section('content')  

<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
<script type="text/javascript" src="js/ruleta.js"></script> 

<canvas id='canvas' width='880' height='300'>
    Canvas not supported, use another browser.
</canvas>
<script>
    let theWheel = new Winwheel();
</script>
@endsection

    


