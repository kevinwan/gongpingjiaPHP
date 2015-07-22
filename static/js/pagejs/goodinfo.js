var choose_Alert = {
    choose_Btn: ".info-choose-txt",
    choose_Tri: ".info-choose-tri",
    choose_play: '.info-choose-in',
    choose_link: ".info-choose-in",
    choose_link_one: ".info-choose-in-one",
    choose_link_two: ".info-choose-in-two",
    //下拉框点击事件
    click_Show:function(){
        var _this = this;
        $(_this.choose_Btn + "," + _this.choose_Tri).click(function(e){
            e.stopPropagation();
            var $this = $(this);
            $(_this.choose_play).hide();
            $this.parent().children(_this.choose_play).show();
        });
        $(_this.choose_link + " a").click(function(e){
            e.stopPropagation();
            var $this = $(this);
            var $choose_link_focus = $this.parents('.info-choose-in').children();
            var $data_value = $(_this.choose_link_two).attr('data-value');

            if(!$choose_link_focus.hasClass('info-choose-in-two')){
                $choose_link_focus.parents('.info-choose-out').children(_this.choose_Btn).val($this.text());
                $(_this.choose_play).hide();
            }else{
                if($this.parent().hasClass("info-choose-in-one")){
                    $(_this.choose_link_one + ' a').removeClass("info-choose-active");
                    $this.addClass('info-choose-active');
                    $(_this.choose_link_two).attr('data-value',$this.text());
                }else{
                    if($data_value != ''){
                        $choose_link_focus.parents('.info-choose-out').children(_this.choose_Btn).val($data_value+ '/' + $this.text());
                        $(_this.choose_play).hide();
                    }
                }
            }
        })
        $(document).on('click',function(e){
            e.stopPropagation();
            $(_this.choose_play).hide();
        })
    }
}

$(document).ready(function() {
    choose_Alert.click_Show();
    $(".info-list").on("click", ".info-match a", function () {
        var checkObj = $(this).children(":checkbox");
        if(checkObj.attr("checked")=="checked") {
            checkObj.attr("checked", false);
            $(this).removeClass("info-match-focus");
        }else {
            checkObj.attr("checked", "");
            $(this).addClass("info-match-focus");
        }
    });
    $(".btn-list").on("click", ".btn-submit", function () {
        $("#srcform").submit();
    });
});
