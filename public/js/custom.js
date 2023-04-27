$(document).ready(function() {
    // $("#welcomBlade").hide();
    // $("#itemModal").hide();
    console.log("hello");
    $.ajax({
      type: "GET",
      url: "/api/announcement/all",
      dataType: 'json',
      success: function (data) {
        $.each(data, function( i, value ) {
            $('#no-announcement').css('display', 'none');
            $('#card-announcement').show();
            var cardAnnouncement = $('.card').first().clone();
            cardAnnouncement.find('.card-title').text(value.heading);
            cardAnnouncement.find('#article_img').text(value.article_img);
            cardAnnouncement.find('.articleCreatedAt').text(value.created_at);
            $('.card').append(cardAnnouncement); 
        });
        console.log(data);
        
      },
      error: function(){
        console.log('AJAX load did not work');
        alert("error");
      }
    }); 
  });// end document.ready 
$(document).ready(function() {
  
}); 