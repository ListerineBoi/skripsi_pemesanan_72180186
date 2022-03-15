var $disparent = $( '#disparent' );
$disparent.on( 'change', function() {
    if(this.value=='0'){
        document.getElementById('dischild1').placeholder ='Lunas';
        $("#dischild1").attr('disabled', true);
    }else if(this.value=='1'){
        document.getElementById('dischild1').placeholder ='Isi Nominal Yang Terbayar';
        $("#dischild1").attr('disabled', false);
    }
} ).trigger( 'change' );