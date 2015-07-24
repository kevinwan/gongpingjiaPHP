<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>公平价正带您前往</title>
</head>
<link href="$static/css/linksite.css" rel="stylesheet" type="text/css" />
<script src="$static/js/jquery/jquery-1.11.1.js"></script>
<script type="text/javascript">
    function getParameter(sProp) {
        var re = new RegExp(sProp + "=([^\&]*)", "i");
        var a = re.exec(document.location.search);
        if (a == null) {
            return null;
        }
        return a[1];
    }
    $(function()
    {
        var siteUrl = document.URL
        goSiteFn(decodeURI(getParameter("sname")), getParameter("slink"))
    })
    /*跳转第三方网站*/
    function goSiteFn(name, link)
    {
        $(".cds_linkCon h2 span").text(name);
        $(".cds_linkCon a").attr('href',link);
        $(".cds_linkBox").show();
        var time;
        var n = 2;
        time = setInterval(function()
        {
            n--;
            $(".cds_linkCon p span").text(n)
            if(n<0)
            {
                clearInterval(time);
                n=0;
                $(".cds_linkBox").hide();
                window.location.href = link;
            }

        },1000)
    }
</script>
<body>

<!--跳转第三方网站-->
<div class="cds_linkBox">
    <div class="cds_linkbg"></div>
    <div class="cds_linkCon">
        <h1>提示</h1>
        <h2>公平价正带您前往<span></span></h2>
        <p><span>2</span>秒后自动跳转</p>
        <a href="#">立即前往</a>
    </div>
</div>
</body>
</html>