
$(function() {
    $(".A").click(function() {
        $(".kensaku").slideToggle("");
    });
});
$(function() {
    $(".B").click(function() {
        $(".shibori").slideToggle("");
    });
});
$(function() {
    $(".C").click(function() {
        $(".C-main").slideToggle("");
    });
});
$(function() {
    $(".D").click(function() {
        $(".D-main").slideToggle("");
    });
});
$(function() {
    $(".E").click(function() {
        $(".E-main").slideToggle("");
    });
});
$(function() {
    $(".F").click(function() {
        $(".F-main").slideToggle("");
    });
});

function Colorall(checkbox) {
    var checkboxes = document.querySelectorAll('#color');
    checkboxes.forEach(function(cb) {
        if (cb !== checkbox) {
            cb.checked = checkbox.checked;
        }
    });
}

function Cateall(checkbox) {
    var checkboxes = document.querySelectorAll('#cate');
    checkboxes.forEach(function(cb) {
        if (cb !== checkbox) {
            cb.checked = checkbox.checked;
        }
    });
}

function Brandall(checkbox) {
    var checkboxes = document.querySelectorAll('#brand');
    checkboxes.forEach(function(cb) {
        if (cb !== checkbox) {
            cb.checked = checkbox.checked;
        }
    });
}
function Priceall(checkbox) {
    var checkboxes = document.querySelectorAll('#price');
    checkboxes.forEach(function(cb) {
        if (cb !== checkbox) {
            cb.checked = checkbox.checked;
        }
    });
}




