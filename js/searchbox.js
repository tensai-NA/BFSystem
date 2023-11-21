
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


let checkAll1 = document.getElementById("checkAll1");
//「全て選択」以外のチェックボックス
let el1 = document.getElementsByClassName(".brand");

//全てにチェックを付ける・外す
const funcCheckAll = (bool) => {
    for (let i = 0; i < el1.length; i++) {
        el1[i].checked = bool;
    }
};

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェックをON/OFFする
const funcCheck1 = () => {
    let count = 0;

    for (let i = 0; i < el1.length; i++) {
        if (el1[i].checked) {
            count += 1;
        }
    }

    if (el1.length === count) {
        checkAll1.checked = true;
    } else {
        checkAll1.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAll1.addEventListener(
    "click",
    () => {
        funcCheckAll(checkAll1.checked);
    },
    false
);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el1.length; i++) {
    el1[i].addEventListener("click", funcCheck, false);
}





            let checkAll2 = document.getElementById("checkAll2");
        //「全て選択」以外のチェックボックス
        let el2 = document.getElementsByClassName(".color");

        //全てにチェックを付ける・外す
        const funcCheckAll2 = (bool) => {
            for (let i = 0; i < el2.length; i++) {
                el2[i].checked = bool;
            }
        };

        //「checks」のclassを持つ要素のチェック状態で「全て選択」のチェックをON/OFFする
        const funcCheck2 = () => {
            let count = 0;

            for (let i = 0; i < el2.length; i++) {
                if (el2[i].checked) {
                    count += 1;
                }
            }

            if (el2.length === count) {
                checkAll2.checked = true;
            } else {
                checkAll2.checked = false;
            }
        };

        //「全て選択」のチェックボックスをクリックした時
        checkAll2.addEventListener(
            "click",
            () => {
                funcCheckAll(checkAll2.checked);
            },
            false
        );

        //「全て選択」以外のチェックボックスをクリックした時
        for (let i = 0; i < el2.length; i++) {
            el2[i].addEventListener("click", funcCheck, false);
        }

            let checkAll3 = document.getElementById("checkAll3");
            //「全て選択」以外のチェックボックス
            let el3 = document.getElementsByClassName(".prices");

            //全てにチェックを付ける・外す
            const funcCheckAll3 = (bool) => {
                for (let i = 0; i < el3.length; i++) {
                    el3[i].checked = bool;
                }
            };

            //「checks」のclassを持つ要素のチェック状態で「全て選択」のチェックをON/OFFする
            const funcCheck3 = () => {
                let count = 0;

                for (let i = 0; i < el3.length; i++) {
                    if (el3[i].checked) {
                        count += 1;
                    }
                }

                if (el3.length === count) {
                    checkAll3.checked = true;
                } else {
                    checkAll3.checked = false;
                }
            };

            //「全て選択」のチェックボックスをクリックした時
            checkAll3.addEventListener(
                "click",
                () => {
                    funcCheckAll(checkAll3.checked);
                },
                false
            );

            //「全て選択」以外のチェックボックスをクリックした時
            for (let i = 0; i < el3.length; i++) {
                el3[i].addEventListener("click", funcCheck, false);
            }