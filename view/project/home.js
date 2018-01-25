$(function(){
    console.log(projInfo);

    jQuery(function(){
        var dt = new Date();
        $('#retroclockbox1').flipcountdown({
            size: 'md',
            beforeDateTime:'1/20/2028 00:00:00'
        });
    });
})
