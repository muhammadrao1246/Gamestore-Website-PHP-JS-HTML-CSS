

    //initializing both picture containers 
    var crop_tool_window=document.getElementsByClassName('cropping-container')[0];

    var target_image=document.getElementsByClassName('target')[0];

    const loader=document.getElementsByClassName('loader-1');
    var loader_flag=0;
    loader[0].style.display="none";
    loader[1].style.display="none";

    var moving_div= document.getElementsByClassName('resizable')[0];
    moving_div.style.display="none";
    var current_left=current_top=0;
    var top_limit=left_limit =bottom_limit= right_limit =0;
    var div_top=div_left=0;

    var cropped_div=document.getElementsByClassName('cropped-image')[0];

    var dummy_image_original=document.getElementsByClassName('target')[1];

    //image which is uploaded
    var uploaded_image=document.getElementById('img');
    
    var actual_width=actual_height=0;

    // import { image_flag } from "signup.js";

    //showing uploadded picture in targeted div
    function uploaded_image_controller() 
    {
            loader_flag = 1;
            loader[0].style.display="flex";
            loader[1].style.display="flex";

            display_images();
            moving_div.style.display="none";
            
            
            //getting width and height
            setTimeout(() => {
                uploaded_picture_dimensions();
            }, 1500);

            if (actual_width > 350 && actual_height > 350) 
            {
                // image_flag=1;
                setTimeout(() => {
                    //reset moving divs
                    set_moving_div_initially();
                }, 2000);
 
                setTimeout(() => {
                    loader[0].style.display="none";
                    loader[1].style.display="none";
                    loader_flag = 0;
                }, 4000);
                
            }
            else
            {
                return -1;
            }
            
        }

    //showing picture after upload
    function display_images() 
    {
        
        //throwing sources

        target_image.src = URL.createObjectURL(uploaded_image.files[0]);

        dummy_image_original.src=target_image.src;//showing in dummy image 

        target_image.style.display="block";
        dummy_image_original.style.display="block";

        //remove background of cropped-image container
        cropped_div.style.backgroundImage = "unset";    
    }

    //saving current picture dimensions
    function uploaded_picture_dimensions() 
    {
        var picture_width  = Number((target_image.getBoundingClientRect().width));
        var picture_height = Number((target_image.getBoundingClientRect().height));
        
     
        //also set cropped image dimensions accroding to cropped section

        document.getElementsByClassName('cropper')[1].style.width = Number((cropped_div.getBoundingClientRect().width)) +'px';
        document.getElementsByClassName('cropper')[1].style.height= Number((cropped_div.getBoundingClientRect().height)) + 'px';
        
        //picture dimensions on view
        actual_width = picture_width;
        actual_height = picture_height;
    }

    //setting moving div position according to the image
    function set_moving_div_initially() 
    {
        
        console.log('Left: '+left_limit+' Top: '+top_limit+' bottom: '+bottom_limit+' right: '+right_limit);

        left_limit = current_left = Number(target_image.getBoundingClientRect().left);
        top_limit  = current_top = Number(target_image.getBoundingClientRect().top);

        bottom_limit = actual_height + Number(target_image.getBoundingClientRect().top);
        right_limit = actual_width + Number(target_image.getBoundingClientRect().left);
        
        console.log('Left: '+left_limit+' Top: '+top_limit+' bottom: '+bottom_limit+' right: '+right_limit);
        
        moving_div.style.left = current_left + 'px';
        moving_div.style.top  = current_top  + 'px';

        //crooped sector visible
        dummy_image_original.style.objectPosition="-"+(current_left - left_limit)+"px -"+(current_top - top_limit)+"px";

        //making visible moving div
        moving_div.style.display="block";

        //setting div movement handlers to 0
        div_top=div_left=0;
    }

      
        //movement handlers
        var left=document.getElementById('left');

        var right=document.getElementById('right');

        var up=document.getElementById('up');

        var down=document.getElementById('down');

    //movement listeners  and calculators  

    
    var pointer="";
    var prev_x=0;
    var prev_y=0;
    moving_div.addEventListener('pointerdown',e=>
    {
        console.log("Pointer Down: "+moving_div.style.cursor);
        moving_div.addEventListener('pointermove',mouse_event_constroller);

    });

    //Onpointerup change cursor
    moving_div.addEventListener('pointerup',()=>
    {
        moving_div.removeEventListener('pointermove',mouse_event_constroller);
        moving_div.style.cursor="grab";
        console.log("Pointer Up: "+moving_div.style.cursor);
    });

    //MOUSE_EVENT_CONTROLLER
    const mouse_event_constroller=
    (e1)=>
        {
            moving_div.style.cursor="grabbing";
            
            console.log("Pointer Move: "+moving_div.style.cursor);
            pointer=e1;
            console.log("MOUSE X: "+e1.clientX +" MOUSE Y: "+e1.clientY);
            if (e1.clientX > prev_x) 
            {
                move_right(Number(1));
            }
            else if (e1.clientY > prev_y)
            {
                move_down(Number(1));
            }
            else if( e1.clientX < prev_x )
            {
                move_left(Number(1));
            }
            else if( e1.clientY < prev_y )
            {
                move_up(Number(1));
            }
            else if( e1.clientX > prev_x && e1.clientY > prev_y)
            {
                move_right(Number(1));
                move_down(Number(1));
            }
            else if( e1.clientX < prev_x && e1.clientY < prev_y )
            {
                move_left(Number(1));
                move_up(Number(1));
            }
            else if( e1.clientX > prev_x && e1.clientY < prev_y)
            {
                move_right(Number(1));
                move_up(Number(1));
            }
            else if( e1.clientX < prev_x && e1.clientY > prev_y )
            {
                move_left(Number(1));
                move_down(Number(1));
            }
            
            prev_x=e1.clientX;
            prev_y=e1.clientY;       
        }

    //onclick move as many pixel
    
    function after_single_click_remove_effect() 
    {
        setTimeout(() => {
            remove_effect();
        }, 300);
    }
    
    left.onclick  = () => {    run_at_event({key:"ArrowLeft"});     after_single_click_remove_effect(); };
    right.onclick = () => {    run_at_event({key:"ArrowRight"});    after_single_click_remove_effect(); };
    up.onclick    = () => {    run_at_event({key:"ArrowUp"});       after_single_click_remove_effect(); };
    down.onclick  = () => {    run_at_event({key:"ArrowDown"});     after_single_click_remove_effect(); };

    //onhold move as many pixel
    
    function remove_effect() 
    {
            left.className=left.className.replace(/( button_on)/g,"");
            right.className=right.className.replace(/( button_on)/g,"");
            up.className=up.className.replace(/( button_on)/g,""); 
            down.className=down.className.replace(/( button_on)/g,"");
    }

    crop_tool_window.onkeydown = (e) => {   run_at_event(e);            };
    crop_tool_window.onkeyup   = ( ) => {   remove_effect("nothing");   };
    
    function run_at_event(e)
    {
        console.log(e.key);
        if ( loader_flag != 1) 
        {
            if(e.key == 'ArrowUp') {
            move_up(Number(1));
            if (!(/( button_on)/.test(up.className))) up.className+=" button_on";
            }
            if(e.key == 'ArrowDown') {
                move_down(Number(1));
                if (!(/( button_on)/.test(down.className))) down.className+=" button_on";
            }
            if(e.key == 'ArrowLeft') {
                move_left(Number(1));
                if (!(/( button_on)/.test(left.className))) left.className+=" button_on";
            }
            if(e.key == 'ArrowRight') {
                move_right(Number(1));
                if (!(/( button_on)/.test(right.className))) right.className+=" button_on";
            }
        }
    }

    //movement functionality

    function get_current_position() 
    {
        current_top=  Number(moving_div.getBoundingClientRect().top);
        current_left= Number(moving_div.getBoundingClientRect().left); 
    }

    function move_left(inc)
    {
        get_current_position();
        if( current_left > left_limit )
        {
            div_left = current_left - 1;
            div_top=current_top;
            Set_Position_of_moveable_div_and_cropped_container();
        }
         
    }
    function move_right(inc)
    {
        get_current_position();
        if( current_left < right_limit )
        {
            div_left = current_left + 1;
            div_top=current_top;
            Set_Position_of_moveable_div_and_cropped_container(); 
        }
    }
    function move_up(inc)
    {
        get_current_position();
        if( current_top > top_limit )
        {
            div_top = current_top - 1;
            div_left=current_left;
            Set_Position_of_moveable_div_and_cropped_container(); 
        }      
    }
    function move_down(inc)
    {
        get_current_position();
        if( current_top < bottom_limit )
        {
            div_top = current_top + 1;
            div_left=current_left;
            Set_Position_of_moveable_div_and_cropped_container(); 
        }       
    }

    function Set_Position_of_moveable_div_and_cropped_container() 
    {
        console.log('After key press Top: '+div_top+' After Key Press Left: '+div_left);
        moving_div.style.top=div_top+'px';
        moving_div.style.left=div_left+'px';

        //crooped sector visible
        dummy_image_original.style.objectPosition="-"+(div_left - left_limit)+"px -"+(div_top - top_limit)+"px";

    }

