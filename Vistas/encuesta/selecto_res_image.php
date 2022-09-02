<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="590" id="offcanvasimagenes" aria-labelledby="offcanvasWithBackdropLabel" style="z-index: 100000;">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">ELIJE UNA IMAGEN:</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <div style="display:flex; flex-wrap: wrap; grid-gap: 5px;" id="contenedor_imgs">
        <?php foreach(V::$data->imagenes_res as $img)  { ?>

            <div class="hoverscale" url_absolute="<?php echo $img->url_absolute;?>"  url_relative="<?php echo $img->url_relative;?>"  extension="<?php echo $img->extension;?>">
            <?php if($img->extension=='png' || $img->extension=='jpg'){ ?>
            <img style="width: 50px; height: 50px;" src="<?php echo $img->url_absolute;?>" alt="<?php echo $img->file_name;?>" url_relative="<?php echo $img->url_relative;?>">
            <?php } ?>

            <?php if($img->extension=='json'){ ?>
            <lottie-player style="width: 50px; height: 50px;" src="<?php echo $img->url_absolute;?>" alt="<?php echo $img->file_name;?>" url_relative="<?php echo $img->url_relative;?>"  background="transparent"  speed="1" loop autoplay></lottie-player>
            <?php } ?>
            </div>

        <?php } ?>
    </div>
  </div>

  <script>
    function showSelectImagenesRes(input_url,src_img,src_json){
        $('#offcanvasimagenes').offcanvas('show');
        $('#offcanvasimagenes').find('#contenedor_imgs').find('div').off("click");
        $('#offcanvasimagenes').find('#contenedor_imgs').find('div').click(function(){
            //event.stopPropagation();
            input_url.value=this.getAttribute('url_relative');
            if(this.getAttribute('extension')=='json'){
                var absolute_url=this.getAttribute('url_absolute');
                //src_json.src=absolute_url;
                src_json.setAttribute('src',absolute_url);
                src_json.load(absolute_url);
                src_json.style.display='block';
                src_img.style.display='none';
            }else{
                src_img.style.display='block';
                src_img.src=this.getAttribute('url_absolute');
                src_json.style.display='none';
            }
        });

       // $('#offcanvasimagenes').find('#contenedor_imgs').on('click', 'div', function() {
           // alert(this.getAttribute('url_relative'));
         //   input_url.value=this.getAttribute('url_relative');
        /*
        var moo = $(this).attr('id');
        if (handlers[id]) {
            event.stopPropagation();
            handlers[id]();
    }*/
    //});
}
  </script>
</div>