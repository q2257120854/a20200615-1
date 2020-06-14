(function($) {
    var __m = {
        c:null,
        opts:[],
        easings:{
            jswing:'jswing',
            easeInQuad:'easeInQuad',
            easeOutQuad:'easeOutQuad',
            easeInOutQuad:'easeInOutQuad',
            easeInCubic:'easeInCubic',
            easeOutCubic:'easeOutCubic',
            easeInOutCubic:'easeInOutCubic',
            easeInQuart:'easeInQuart',
            easeOutQuart:'easeOutQuart',
            easeInOutQuart:'easeInOutQuart',
            easeInQuint:'easeInQuint',
            easeOutQuint:'easeOutQuint',
            easeInOutQuint:'easeInOutQuint',
            easeInSine:'easeInSine',
            easeOutSine:'easeOutSine',
            easeInOutSine:'easeInOutSine',
            easeInExpo:'easeInExpo',
            easeOutExpo:'easeOutExpo',
            easeInOutExpo:'easeInOutExpo',
            easeInCirc:'easeInCirc',
            easeOutCirc:'easeOutCirc',
            easeInOutCirc:'easeInOutCirc',
            easeInElastic:'easeInElastic',
            easeOutElastic:'easeOutElastic',
            easeInOutElastic:'easeInOutElastic',
            easeInBack:'easeInBack',
            easeOutBack:'easeOutBack',
            easeInOutBack:'easeInOutBack',
            easeInBounce:'easeInBounce',
            easeOutBounce:'easeOutBounce',
            easeInOutBounce:'easeInOutBounce'
        },
        animates:{
            flipX :{
                i:'flipInX',
                o:'flipOutX'
            },
            flipY :{
                i:'flipInY',
                o:'flipOutY'
            },
            fadeUp :{
                i:'fadeInUp',
                o:'fadeOutUp'
            },
            fadeDown :{
                i:'fadeInDown',
                o:'fadeOutDown'
            },
            fadeLeft :{
                i:'fadeInLeft',
                o:'fadeOutLeft'
            },
            fadeRight :{
                i:'fadeInRight',
                o:'fadeOutRight'
            },
            fadeUpBig :{
                i:'fadeInUpBig',
                o:'fadeOutUpBig'
            },
            fadeDownBig :{
                i:'fadeInDownBig',
                o:'fadeOutDownBig'
            },
            fadeLeftBig :{
                i:'fadeInLeftBig',
                o:'fadeOutLeftBig'
            },
            fadeRightBig :{
                i:'fadeInRightBig',
                o:'fadeOutRightBig'
            },
            bounce :{
                i:'bounceIn',
                o:'bounceOut'
            },
            bounceUp :{
                i:'bounceInUp',
                o:'bounceOutUp'
            },
            bounceDown :{
                i:'bounceInDown',
                o:'bounceOutDown'
            },
            bounceLeft :{
                i:'bounceInLeft',
                o:'bounceOutLeft'
            },
            bounceRight :{
                i:'bounceInRight',
                o:'bounceOutRight'
            },
            rotate :{
                i:'rotateIn',
                o:'rotateOut'
            },
            rotateUpLeft :{
                i:'rotateInUpLeft',
                o:'rotateOutUpLeft'
            },
            rotateUpRight :{
                i:'rotateInUpRight',
                o:'rotateOutUpRight'
            },
            rotateDownLeft :{
                i:'rotateInDownLeft',
                o:'rotateOutDownLeft'
            },
            rotateDownRight :{
                i:'rotateInDownRight',
                o:'rotateOutDownRight'
            },
            lightSpeed :{
                i:'lightSpeedIn',
                o:'lightSpeedOut'
            },
            roll :{
                i:'rollIn',
                o:'rollOut'
            }
        },
        types:{
            info:'info',
            success:'success',
            error:'error'
        },
        effects:{
            slide:'slide',
            fade:'fade'
        },
        timer:[],
        init:function (opts){
            var id = __m.guid();
            if (opts.delay != undefined){
                opts.delay = parseInt(opts.delay);
            }
            opts = (opts != undefined)?opts:{};
            opts = $.extend(true,{
                img:'',
                type:'success',
                content:'&nbsp;',
                html:true,
                autoClose:true,
                timeOut:3000,
                delay:0,
                position:'topRight',
                effect:'slide',
                animate:'',
                easing:'jswing',
                duration:300,
                width:400,
                buttons:[],
            onStart:function(id){},
            onShow:function(id){},
            onClose:function(id){}
       
        },opts);
            
    if (__m.easings[opts.easing] == undefined){
        opts.easing = 'jswing';
    }
            
    if (__m.types[opts.type] == undefined){
        opts.type = '';
    }
            
    if (__m.effects[opts.effect] == undefined){
        opts.effect = 'slide';
    }
            
    if (__m.c == null){
        __m.c = $('<div></div>').css({
            position:'fixed',
            zIndex:2000
        });
        switch(opts.position){
            case 'topLeft':
                __m.c.css({
                    top:'0px',
                    left:'0px'
                });
                break;
            case 'topRight':
                __m.c.css({
                    top:'0px',
                    right:'0px'
                });
                break;
            case 'bottomLeft':
                __m.c.css({
                    bottom:'0px',
                    left:'0px'
                });
                break;
            case 'bottomRight':
                __m.c.css({
                    bottom:'0px',
                    right:'0px'
                });
                break;
        }
                
        __m.c.width(opts.width).appendTo('body');
    }else{
        __m.c.attr({
            style:''
        });
        __m.c.css({
            position:'fixed',
            zIndex:2000
        });
        switch(opts.position){
            case 'topLeft':
                __m.c.css({
                    top:'0px',
                    left:'0px'
                });
                break;
            case 'topRight':
                __m.c.css({
                    top:'0px',
                    right:'0px'
                });
                break;
            case 'bottomLeft':
                __m.c.css({
                    bottom:'0px',
                    left:'0px'
                });
                break;
            case 'bottomRight':
                __m.c.css({
                    bottom:'0px',
                    right:'0px'
                });
                break;
        }
        __m.c.width(opts.width);
    }
    __m.opts[id] = opts;
    
    if (opts.delay > 0){
        setTimeout(function(){
           __m.create(id);
        },opts.delay);
    }else{
        __m.create(id);
    }
    
    return id;
},
create:function(id){
    var o,btn_close;
    var opts = __m.opts[id];
    o = $('<div></div>').attr({
        id:id
    });
    o
    .css({
        margin:'10px',
        paddingRight:'8px',
        display:'none',
        'box-shadow': '0 2px 2px rgba(0, 0, 0, 0.4)'
    })
    .addClass('alert');
            
    switch(opts.type){
        case 'error':
            o.addClass('alert-error');
            break;
        case 'success':
            o.addClass('alert-success');
            break;
        case 'info':
            o.addClass('alert-info');
            break;
    }
            
    // add close button
    btn_close = $('<button class="close" type="button">×</button>');
    btn_close.css({
        top:'-5px',
        right:'0px'
    })
    btn_close.data('parent_id',id);
    btn_close.click(function(){
        var id = $(this).data('parent_id');
        clearTimeout(__m.timer[id]);
        __m.close(id);
    });
    o.append(btn_close);
    var table = $('<table></table>');
    var tr = $('<tr></tr>');
    table.append(tr);
    if ($.trim(opts.img) != ''){
        var img = $('<img />').attr({
            src:opts.img
        })
        .css({
            border:'0px', 
            marginRight:'10px',
            marginBottom:'10px'
        });
        tr.append($('<td></td>').attr({
            valign:'top'
        }).append(img));
    }
    var td2 = $('<td></td>').attr({
        valign:'top'
    });
    tr.append(td2);
    if (opts.html == true){
        td2.append(opts.content);
    }else{
        td2.append(jQuery('<div />').html(opts.content).text());
    }
    var d1 = $('<div></div>');
    d1.css({
        paddingRight:'20px'
    }).append(table);
    o.append(d1);
    if (opts.buttons.length > 0){
        var btnc = $('<div></div>');
        btnc.css({
            textAlign:'right'
        });
        for(var i = 0; i < opts.buttons.length; i++){
            var btn = $('<input type="button" class="btn"/>');
            if (opts.buttons[i].text != undefined){
                btn.attr({value:opts.buttons[i].text});
            }
            if (opts.buttons[i].addClass != undefined){
                btn.addClass(opts.buttons[i].addClass);
            }
            if (opts.buttons[i].click != undefined){
                btn.data('i',i);
                btn.click(function(){
                   var _i = parseInt($(this).data('i'));
                   opts.buttons[_i].click(id);
                });
            }
            btnc.append(btn).append(' ');
        }
                        
        o.append(btnc);
    }
                        
            
    o.appendTo(__m.c);
    opts.onStart(id);
    if (__m.animates[opts.animate] != undefined){
        o.addClass('animated '+ __m.animates[opts.animate].i);
    }
    switch (opts.effect){
        case 'slide':
            o.slideDown(opts.duration,opts.easing);
            break;
        case 'fade':
            o.fadeIn(opts.duration,opts.easing);
            break;
    }
    opts.onShow(id);
            
    __m.timer[id] = setTimeout(function(){
        __m.remove(id);
    },opts.timeOut);
},
remove:function(id){
    var opts = __m.opts[id];
    var o = $('#'+id);
    if (opts.autoClose == true && opts.buttons.length <= 0){
        __m.close(id);
    }
},
close:function (id){
    var opts = __m.opts[id];
    var o = $('#'+id);
    opts.onClose(id);
    if (__m.animates[opts.animate] != undefined){
        o.addClass('animated '+ __m.animates[opts.animate].o);
    }
    switch (opts.effect){
        case 'slide':
            o.slideUp(opts.duration,opts.easing,function(){
                $(this).remove();
            });
            break;
        case 'fade':
            o.fadeOut(opts.duration,opts.easing,function(){
                $(this).remove();
            });
            break;
    }
},
guid:function() {
    var S4 = function() {
        return Math.floor(Math.random() * 0x10000 /* 65536 */
            ).toString(16);
    };
    return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
}
};
$.notification = function(o,id){
    id = (id != undefined)?id:'';
    switch (typeof o){
        case 'object':
            return __m.init(o);
            break;
        case 'string':
            switch (o){
                case 'close':
                    __m.close(id);
                    break;
            }
            break;
    }
        
};
})(jQuery);
