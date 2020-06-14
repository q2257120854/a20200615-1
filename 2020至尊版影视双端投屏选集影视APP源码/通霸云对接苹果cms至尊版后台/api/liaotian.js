
    new Vue({
        el:"#vue-content",
        data:{
            giftName:"",
            height:"",
            inputValue:"",
            metext:"我",
            inputList:[],
            //announcement:"消息:欢迎来到直播间，请文明发言。"
        },
        methods:{
            handelClick:function(){
                this.inputList.push(this.inputValue);
                this.inputValue="";
                var height1=document.getElementById("inputUl").offsetHeight;
                var height2=document.getElementById("message").offsetHeight;
                var height = height2-height1-24;
//                console.log(height);
                if(height<=0){
                    document.getElementById("inputUl").style.marginTop = height+"px";
                }

            },
            giftClick:function(){
                if(this.giftName==""){
                    this.giftName="active";
                }else{
                    this.giftName="";
                }

            }
        }
    })




    function addMsg (){
        var testData=[

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>暖阳~~</span>:撩撩吧??</li>",
						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#009900'>首席团长</span>:大白兔</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>豪哥</span>:这个保养的好??</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#E81010'>春天的我</span>:可以加VX吗</li>",
						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#E81010'>做好准备了哦</span>:妹子给大爷跳一个呗</li>",
						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#E81010'>范进中举</span>:哪里的??</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>风一样的男人</span>:听不清????</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#8B0279'>我是我自己的人生</span>:加微信吗</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>看一下午</span>:主播微信多少</li>",
						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FEC400'>菜的很逼真</span>:厉害了</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>霸气侧漏的小男银</span>:真好看</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>待我称王带你狂</span>:你现在有男朋友吗？</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>狗逼是你</span>:什么都??没看到</li>",
						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>王者为她战天下</span>:没劲爆表演吗？</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#339900'>动我女神全撸倒</span>:主播哪里的？</li>",
						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>小三称霸天下</span>:看你直播真费纸巾</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>斜倚云端</span>:叫啥名字</li>",
						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>笑你浪荡</span>:主播一般什么时候开播</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>铁石心肠</span>:情??书是我抄的，但爱你是真的</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FEC400'>配角而已,何必入戏</span>:塞得满满的</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>挥剑指苍天</span>:你好漂亮??</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#009900'>心上一道疤而已</span>:姐姐好</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#E81010'>记忆伤人心</span>:动作倒是挺多的</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>错觉</span>:回去找??你玩</li>",

						"<li class='message-list' id='addMsg'><span class='nickname' style='color:#FFA500'>文艺小痞子</span>:我喜欢</li>",

        ];
        var b =testData.length;
        var a =parseInt(Math.random()*b);
        var testD = testData[a];
        $("#inputUl").append(testD);
        var height1=$("#inputUl").height();
        var height2=$("#message").height();
        var height = height2-height1-24;
//        console.log(height);
        if(height<=0){
            $("#inputUl").css("margin-top",height);
        }
    }
    setInterval(addMsg,500);