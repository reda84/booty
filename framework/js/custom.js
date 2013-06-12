   
jQuery(document).ready(function ($){
             
    $(function() {
                
        var Grid = function(){
            var grid_width = 0,
            grid = $("#grid .span1"),
            spans = $("#grid .span1"),
            spanWidth = function(){
                return $("#grid .span1").eq(0).width();    
            },
            spanFullWidth = function(){
                return $("#grid .span1").eq(1).outerWidth(true);    
            },
            gutterWidth = function(){
                return ($("#grid .span1").outerWidth(true) - $("#grid .span1").width());  
            },
            fullWidth = function(){ 
                grid_width = 0;
                spans.each(function(i){
                    grid_width += $(this).outerWidth(true);
                    console.log($(this).outerWidth(true));

                });    
                return grid_width
            },
                    
                    
                    
                    
            adjustGrid= function(grid , colsCount,gutterWidth){
                        
                        
                if($(grid).find(".row-fluid").length > 0)
                    $(grid).find(".row-fluid").html("")
                            
                else{
                    $(grid).append('<div class="row-fluid"></div>');
                }
                        
                var gutterWidth = ((gutterWidth/100) * $(grid).width());
                var allGutterWidth = gutterWidth * (colsCount);
                var allSpansWidth = $(grid).width() - allGutterWidth ;
                var SpanWidth = allSpansWidth/colsCount;
                        
                for (var i = 0; i < colsCount; i++) {
                    var span = "";
                   
                
                    span = $('<div class="span1"></div>').css(
                    {
                        "width": parseInt(SpanWidth),
                        "margin-left":parseInt(gutterWidth)/2,
                        "margin-right":parseInt(gutterWidth)/2
                    });
                
                            
                        
                    $(grid).find(".row-fluid").append(span);
                }
              
                       
                        
            },
            getItemWith=function(item){
               var itemWidth = (item.width() - Grid.spanWidth()) / Grid.spanFullWidth();
               itemWidth++;
                return itemWidth;
               

            },
                    
                    
                    
                    
            init = function (grid, colsCount , gutterWidth){
                adjustGrid(grid,colsCount,gutterWidth);
                $(window).resize(function(){
                    adjustGrid(grid,colsCount,gutterWidth);
                });
            }
                    
            return {
                fullWidth : fullWidth,
                spanWidth : spanWidth,
                gutterWidth : gutterWidth,
                spanFullWidth : spanFullWidth,
                getItemWith:getItemWith,
                init : init
            }
        }();
        // End of the Grid       
                
        Grid.init("#grid",12,2.5);
                
                
                
        $( "#sortable2" ).sortable({
            connectWith: ".connectedSortable",
            placeholder: "ui-state-highlight",
            receive: function( event, ui ) {
                ui.item.width(Grid.spanWidth() + Grid.spanFullWidth()*2);
            
             
                ui.item.css({
                    "margin-left":Grid.gutterWidth() /2,
                    "margin-right":Grid.gutterWidth() /2
                })
                refreshSortable();
            }
        }).disableSelection();
    

          function refreshSortable(){
            console.log("refresh");
               $( "#sortable2 .ui-state-default" ).resizable({
                containment: "#sortable2",
                grid: [ $(".span1").eq(2).outerWidth(true), 0 ],
                maxHeight:40,
                maxWidth: $("#grid").width(),
                minHeight: 40,
                minWidth: Grid.spanWidth(),
                stop:function(){

                    $(".booty-item").each(function(){
                    var item_width = Grid.getItemWith($(this));
                     $(this).find(".item-wdith").eq(0).val(item_width);
                         console.log($(this).find(".item-wdith").eq(0).val())
                    });
                }
            });
            $( "#draggable" ).draggable({
                connectToSortable: "#sortable",
                helper: "clone",
                revert: "invalid",
                stop: function( event, ui ) {
                    
                }
            });
              
          }
          
          
        $("#page-add-item-button").click(function(){
            var item_name = $("#page-select-element-list").val();
            var content_item = $("<li></li>").addClass("booty-item ui-state-default grey-gre ui-resizable");
            content_item.append('<div class="content">'+item_name+'</div>');
            content_item.append('<div class="delete item-action"></div>')
            content_item.append('<div class="edit item-action"></div>')
            content_item.append('<input type="hidden" name="booty_item-name[]" value="'+item_name+'" />')
            content_item.append('<input type="hidden" class="item-wdith" name="booty_item-width[]" value="3" />')
            $("#sortable2").append(content_item);
        
            content_item.width(Grid.spanWidth() + Grid.spanFullWidth()*2)
            .css({
                "margin-left":Grid.gutterWidth() /2,
                "margin-right":Grid.gutterWidth() /2
            });
                    
           refreshSortable();
        
              
        });
       
      refreshSortable();


      $("#sortable2 li").each(function(){

        $width = $(this).find(".item-wdith").val()
        $(this).width(Grid.spanWidth() + Grid.spanFullWidth()*($width - 1)  )
            .css({
                "margin-left":Grid.gutterWidth() /2,
                "margin-right":Grid.gutterWidth() /2
            });
      })

    });
   
    $(function() {
 
        $( "#draggable" ).draggable({
            connectToSortable: "#sortable",
            helper: "clone",
            revert: "invalid",
            stop: function( event, ui ) {
                 
            }
        });
        $( "ul, li" ).disableSelection();
    });
    
});
