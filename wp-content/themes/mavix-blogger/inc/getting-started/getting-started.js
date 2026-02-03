jQuery( document ).ready( function($) {
    $( '.mavix-blogger-install-plugins' ).click( function (e) {
        e.preventDefault();

        $( this ).addClass( 'updating-message' );
        $( this ).text( mavix_blogger_adi_install.btn_text );

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action     : 'mavix_blogger_getting_started',
                security : mavix_blogger_adi_install.nonce,
                slug : 'elementor',
                request : 1
            },
            success:function( response ) {
                setTimeout( function(){
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action     : 'mavix_blogger_getting_started',
                            security : mavix_blogger_adi_install.nonce,
                            slug : 'elementskit-lite',
                            request : 2
                        },
                        success:function( response ) {
                            setTimeout( function(){
                                $.ajax({
                                    type: "POST",
                                    url: ajaxurl,
                                    data: {
                                        action     : 'mavix_blogger_getting_started',
                                        security : mavix_blogger_adi_install.nonce,
                                        slug : 'kirki',
                                        request : 3
                                    },
                                    success:function( response ) {
                                        setTimeout( function(){
                                            $.ajax({
                                                type: "POST",
                                                url: ajaxurl,
                                                data: {
                                                    action     : 'mavix_blogger_getting_started',
                                                    security : mavix_blogger_adi_install.nonce,
                                                    slug : 'creativ-demo-importer',
                                                    request : 4
                                                },
                                                success:function( response ) {
                                                    var extra_uri, redirect_uri, dismiss_nonce;
                                                    redirect_uri         = mavix_blogger_adi_install.adminurl+'admin.php?page=ct-options';
                                                    window.location.href = redirect_uri;
                                                },
                                                error: function( xhr, ajaxOptions, thrownError ){
                                                    console.log( thrownError );
                                                }
                                            });
                                        }, 500);
                                    },
                                    error: function( xhr, ajaxOptions, thrownError ){
                                        console.log( thrownError );
                                    }
                                });
                            }, 500);
                        },
                        error: function( xhr, ajaxOptions, thrownError ){
                            console.log( thrownError );
                        }
                    });
                }, 500);
            },
            error: function( xhr, ajaxOptions, thrownError ){
                console.log( thrownError );
            }
        });
    } );

});

