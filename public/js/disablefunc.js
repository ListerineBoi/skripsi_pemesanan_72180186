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

var $disparent1 = $( '#disparent1' );
$disparent1.on( 'change', function() {
    if(this.value=='0'){
        $("#dischild").attr('disabled', false);
        $("#dischild2").attr('disabled', false);
    }else if(this.value=='1'){
        $("#dischild").attr('disabled', false);
        $("#dischild2").attr('disabled', true);
    }else if(this.value=='2'){
        $("#dischild").attr('disabled', true);
        $("#dischild2").attr('disabled', false);
    }else if(this.value=='3'){
        $("#dischild").attr('disabled', false);
        $("#dischild2").attr('disabled', true);
    }
} ).trigger( 'change' );