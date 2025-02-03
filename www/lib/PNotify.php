<script>
    function loginChkLoca(){
        const notice = PNotify.info({
            title: '로그인 후 이용가능합니다.',
            text: '로그인 화면으로 이동하시겠습니까?',
            icon: 'fa fa-exclamation-triangle',
            hide: false, // 자동으로 닫히지 않도록 설정
            closer: false, // 닫기 버튼 비활성화
            sticker: false, // 스티커 버튼 비활성화
            destroy: true, // 알림을 클릭으로 제거 가능하도록 설정
            stack: new PNotify.Stack({
                dir1: 'down',
                modal: true,
                firstpos1: 25,
                overlayClose: false
            }),
            modules: new Map([
                ...PNotify.defaultModules,
                [PNotifyConfirm, {
                    confirm: true,
                    buttons: [
                        {
                            text: '확인',
                            click: (notice) => {
                                location.href = 'login.php';
                            }
                        },
                        {
                            text: '취소',
                            click: (notice) => {
                                location.href = 'trvMain2.php';
                            }
                        }
                    ]
                }]
            ])
        });
    }

    function loginChkClos(){
        const notice = PNotify.info({
            title: '로그인 후 이용가능합니다.',
            text: '로그인 화면으로 이동하시겠습니까?',
            icon: 'fa fa-exclamation-triangle',
            hide: false, // 자동으로 닫히지 않도록 설정
            closer: false, // 닫기 버튼 비활성화
            sticker: false, // 스티커 버튼 비활성화
            destroy: true, // 알림을 클릭으로 제거 가능하도록 설정
            stack: new PNotify.Stack({
                dir1: 'down',
                modal: true,
                firstpos1: 25,
                overlayClose: false
            }),
            modules: new Map([
                ...PNotify.defaultModules,
                [PNotifyConfirm, {
                    confirm: true,
                    buttons: [
                        {
                            text: '확인',
                            click: (notice) => {
                                location.href = 'login.php';
                            }
                        },
                        {
                            text: '취소',
                            click: notice => notice.close()
                        }
                    ]
                }]
            ])
        });
    }

    function eqChk(type,text){
        if (typeof window.stackModal === 'undefined') {
            window.stackModal = new PNotify.Stack({
            dir1: 'up',
            firstpos1: 25,
            push: 'top',
            modal: true,
            maxOpen: Infinity
            });
        }
        const opts = {
            title: 'Over Here',
            text: "Check me out. I'm in a different stack.",
            stack: window.stackModal,
            modules: new Map([
            ...PNotify.defaultModules,
            [
                PNotifyConfirm,
                {
                confirm: true,
                buttons: [{
                    text: '중복확인',
                    primary: true,
                    click: opts => {
                        opts.close();
                        chkNick(text)
                    }
                }]
                }
            ]
            ])
        };
        switch (type) {
            case 'error':
            opts.title = 'Oh No';
            opts.text = 'Watch out for that water tower!';
            opts.type = 'error';
            break;
            case 'info':
            opts.title = '중복 확인이 인증되지 않았습니다.';
            opts.text = '인증하시겠습니까?';
            opts.type = 'info';
            break;
            case 'success':
            opts.title = 'Good News Everyone';
            opts.text =
                "I've invented a device that bites shiny metal asses.";
            opts.type = 'success';
            break;
        }
        PNotify.alert(opts);
}

function chk(type,text){
    console.log(type+"/"+text + " 확인중")
    pAlert("info","인증완료","사용가능한 "+type+"입니다.",true);
    pAlert("error","인증실패","사용불가능한 "+type+"입니다.",true);
}



function pAlert(type, titleTXT,conTxt,modal) {
    if (typeof window.stackModal === 'undefined') {
            window.stackModal = new PNotify.Stack({
            dir1: 'up',
            firstpos1: 25,
            push: 'top',
            modal: true,
            maxOpen: Infinity
            });
        }
        const opts = {
            title: 'Over Here',
            text: "Check me out. I'm in a different stack.",
            stack: window.stackModal,
            modules: new Map([
            ...PNotify.defaultModules,
            [
                PNotifyConfirm,
                {
                confirm: false
                }
            ]
            ])
        };
        switch (type) {
            case 'error':
            opts.title = titleTXT;
            opts.text = conTxt;
            opts.type = 'error';
            break;
            case 'info':
            opts.title = titleTXT;
            opts.text = conTxt;
            opts.type = 'info';
            break;
            case 'success':
            opts.title = titleTXT;
            opts.text = conTxt;
            opts.type = 'success';
            break;
        }
        PNotify.alert(opts);
}
</script>