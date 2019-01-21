$(".modal .fundo").click( function(){
    $(".modal").fadeOut(750); 
});

$('.fechar').click(function(){
    $(".modal").fadeOut(750); 
});
function sendRating() {
    var form_data = $("form#ratingForm").serialize();
    var form_url = $("form#ratingForm").attr("action");
    var form_method = $("form#ratingForm").attr("method").toUpperCase();
    $.ajax({
        url: form_url,
        type: form_method,
        data: form_data,
        cache: false,
        success: function(){
            $('#ratingSuccess.modal .fundo').fadeIn(750); 
            $('#ratingSuccess').fadeIn(750); 
        },
        error: function(){
            $('#notLoggin.modal .fundo').fadeIn(750); 
            $('#notLoggin').fadeIn(750); 
        }
    });
};


function sendFavorite() {
    var favorite_url = $("a.favoritar").attr("ajax-url");
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: favorite_url,
        type: 'POST',
        data: {_token: CSRF_TOKEN},
        success: function(){
            $('#favoriteSuccess.modal .fundo').fadeIn(750); 
            $('#favoriteSuccess').fadeIn(750); 
            $("a.favoritar").toggleClass('active');
        },
        error: function(evt){
            console.log(evt);
            $('#notLoggin.modal .fundo').fadeIn(750); 
            $('#notLoggin').fadeIn(750); 
        }
    });
    console.log(favorite_url);
    console.log(CSRF_TOKEN);
};