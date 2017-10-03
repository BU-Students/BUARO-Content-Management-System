(function($){
  
  
    $.fn.customPaginate = function(options){
      var paginationContainer = this;
      var itemsToPaginate;


      var defaults = {
        itemsPerPage : 5 
      };
      
      var settings = {}; 
      $.extend(settings, defaults,options);
     
      var itemsPerPage = settings.itemsPerPage ;

      itemsToPaginate = $(settings.itemsToPaginate);
      var numberOfPaginationLinks = Math.ceil((itemsToPaginate.length / itemsPerPage));
      $("<ul></ul>").prependTo(paginationContainer);

      for(var index = 0 ; index < numberOfPaginationLinks; index++){
        paginationContainer.find("ul").append("<li>"+ (index + 1) +"</li>");

      }

      itemsToPaginate.filter(":gt(" + (itemsPerPage - 1) + ")" ).hide();

      paginationContainer.find("ul li").first().addClass(settings.activeClass).end().on('click',function(){
        
        var $this = $(this);
        
        $this.addClass(settings.activeClass);
        $this.siblings().removeClass(settings.activeClass);


        var linkNumber = $this.text();
        
        var itemsToHide = itemsToPaginate.filter(":lt(" + ((linkNumber - 1) * itemsPerPage) + ")" );
        $.merge(itemsToHide,itemsToPaginate.filter(":gt(" + ((linkNumber * itemsPerPage)  - 1 ) + ")" ));
          itemsToHide.hide();

        var itemsToShow = itemsToPaginate.not(itemsToHide);
        itemsToShow.show();

      });


    }
  


}(jQuery));