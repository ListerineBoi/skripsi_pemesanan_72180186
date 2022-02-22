var $qty = $('#qty'),
    $harga = $('#harga');
    $qty.on('change', function(){
        document.getElementById("total").value=parseInt($qty.val())*parseInt($harga.val());  
    }).trigger( 'change' );
    $harga.on('change', function(){
        document.getElementById("total").value=parseInt($qty.val())*parseInt($harga.val());
    }).trigger( 'change' );