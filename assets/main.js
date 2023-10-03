document.addEventListener( 'DOMContentLoaded', function() {
    const TIME_DELAY = 3000;
    const btnAlegraTest = document.getElementById('alegra_test');
    const failed = document.querySelector('.notice__failed');
    const success = document.querySelector('.notice__success');
    const test = document.querySelector('.notice__api');
    const testSuccess = document.querySelector('.notice__api--success');
    let form = document.querySelector('form');

    btnAlegraTest.addEventListener( 'click', testAlegraAPIConnection );

    const data = {
        user: document.querySelector('[name=alegra_user]').value,
        token: document.querySelector('[name=alegra_pass]').value,
    }

    function testAlegraAPIConnection( event ){
        event.preventDefault();
        test.classList.toggle('hidden');

        let params = new URLSearchParams( new FormData( form ) );
        let url = form.dataset.url;


        let newBody = {
            action: 'alegra_test_connection',
            params: params 
        }
        
        fetch( url, { method: 'POST', body: new URLSearchParams( newBody ) } )
            .then( res => res.json() )
            .catch( error => console.log( error ) )
            .then( json => {
                console.log( json );
                test.classList.toggle('hidden');
                testSuccess.classList.toggle('hidden');
                setTimeout( hideNotices, TIME_DELAY );
            } );
    }
});

function hideNotices() {
    let $notices = document.querySelectorAll('.notice');
    $notices = [... $notices ];

    $notices.forEach(  $notice => {
        $notice.classList.add('hidden');
    });
}