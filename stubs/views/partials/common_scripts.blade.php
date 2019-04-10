{{--Google Analytics, etc--}}

<script>
    function showmenu()
    {
        var x = document.getElementById( 'navbar' );
        if ( x.style.display == 'none' )
        {
            x.classList.remove( 'fadeOut' )
            x.classList.add( 'animated', 'fadeIn' )
            x.style.display = 'flex';
        }
        else
        {
            x.classList.remove( 'fadeIn' )
            x.classList.add( 'animated', 'fadeOut' )
            setTimeout( function ()
            {
                x.classList.remove( 'fadeOut', 'animated' )
                x.style.display = 'none';
            }, 300 )
        }
    }

    window.addEventListener( 'resize', function ()
    {
        revealSidebar();
    } );

    document.addEventListener( "DOMContentLoaded", function ()
    {
        revealSidebar();
    } );

    function revealSidebar()
    {
        if ( window.innerWidth >= 768 )
        {
            document.getElementById( 'navbar' ).style.display = 'flex';
        }

    }
</script>