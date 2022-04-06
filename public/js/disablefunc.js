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
        document.getElementById('dischild').value =null;
        $("#dischild").attr('disabled', false);
        document.getElementById('dischild2').value =null;
        $("#dischild2").attr('disabled', false);
    }else if(this.value=='1'){
        document.getElementById('dischild').value =null;
        $("#dischild").attr('disabled', false);
        document.getElementById('dischild2').value =null;
        $("#dischild2").attr('disabled', true);
    }else if(this.value=='2'){
        document.getElementById('dischild').value =null;
        $("#dischild").attr('disabled', true);
        document.getElementById('dischild2').value =null;
        $("#dischild2").attr('disabled', false);
    }else if(this.value=='3'){
        document.getElementById('dischild').value =null;
        $("#dischild").attr('disabled', false);
        document.getElementById('dischild2').value =null;
        $("#dischild2").attr('disabled', true);
    }
} ).trigger( 'change' );