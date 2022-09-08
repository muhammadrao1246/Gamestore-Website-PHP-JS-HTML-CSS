
// import {  } from "crop.js";
// var file= new File(2048,'muhammad.txt');
        //Class Declaration for tick & cross
        var tick  = "<i class='fas fa-check marker marker-green'></i>";
        var cross = "<i class='fas fa-plus marker marker-red'>   </i>";
        var NS    = "<i class='fas fa-plus marker'>              </i>";

        //All Input References
        let input_names = ['uname', 'mail', 'img', 'npass', 'cpass'];

        window[input_names[0]] = document.getElementById(input_names[0]);
        window[input_names[1]] = document.getElementById(input_names[1]);
        window[input_names[2]] = document.getElementById(input_names[2]);
        window[input_names[3]] = document.getElementById(input_names[3]);
        window[input_names[4]] = document.getElementById(input_names[4]);
        
        //Image Validations Robust Algorithm
        var image_flag=0;
        var image_count=0;

        img.onchange = () => { validate_images(); };
        function validate_images()
        {
            var arr=img.files;
            image_flag=0;
            for (const key in arr) 
            {
                image_validate(key,arr);
                if (image_flag==-1) 
                {
                   break;
                }
            }
        }

        function image_validate(index,image)
        { 
            let img_type=/(jpg|png|jpeg|ico)/i;
            if(!isNaN(index))
            {
                if (!!image[index])  
                {
                    if(img_type.test(image[index].type))
                    {
                        if (((image[index].size) / 1024) < 5120) 
                        {
                            
                            if(image_flag==0) pop_tool(index,image);

                            if(image_flag != 0)
                            {
                                if ( image_flag == 1 ) 
                                {
                                    document.getElementById('p-' + input_names[2]).innerText = "";
                                    document.getElementsByClassName('mark-container')[2].innerHTML = tick;
                                    document.getElementsByClassName('mark-container')[2].title = "Image Selected";
                                }
                                else
                                {
                                    pop_resolution_error();
                                    document.getElementById('p-' + input_names[2]).innerText = "*Image Resolution Not Supported !";
                                    document.getElementsByClassName('mark-container')[2].innerHTML = cross;
                                    document.getElementsByClassName('mark-container')[2].title = "Image Not Selected"; 
                                }
                            }
                            
                        } 
                        else 
                        {
                            image_flag=-1;
                            document.getElementById('p-' + input_names[2]).innerText = "*Image size must be less than 5MB(5120KB)";
                            document.getElementsByClassName('mark-container')[2].innerHTML = cross;
                            document.getElementsByClassName('mark-container')[2].title = "Image Not Selected"; 
                            if (!!timeline) { timeline.timeScale(3); timeline.reverse(); }
                        }
                    }
                    else
                    {
                        image_flag=-1;
                        document.getElementById('p-' + input_names[2]).innerText = "*Selected file must type of .png .jpg .jpeg .ico";
                        document.getElementsByClassName('mark-container')[2].innerHTML = cross;
                        document.getElementsByClassName('mark-container')[2].title = "Image Not Selected"; 
                        if (!!timeline) { timeline.timeScale(3); timeline.reverse(); }
                    }
                } 
                else
                {
                    document.getElementById('p-' + input_names[2]).innerText = "";
                    document.getElementsByClassName('mark-container')[2].innerHTML = NS;
                    document.getElementsByClassName('mark-container')[2].title = ""; 
                    if (!!timeline) { timeline.timeScale(3); timeline.reverse(); }
                }
            }
            if (image.length==0) 
            {
                image_count=0;
                image_flag=-1;
                document.getElementById('p-' + input_names[2]).innerText = "*Profile Picture Is Required";
                document.getElementsByClassName('mark-container')[2].innerHTML = cross;
                document.getElementsByClassName('mark-container')[2].title = "Image Not Selected"; 
                if (!!timeline) { timeline.timeScale(3); timeline.reverse(); }
            }
        }
//classes
class animal{
    animal(){

    }
    hello(show) {
        console.log(show);
    }
}
var a = new animal;

        //Cropping Tool Window Config

        //------>Tool Buttons Configs

        var change_picture = document.getElementsByClassName('change-picture')[0];
        var crop = document.getElementsByClassName('crop')[1];
        
        crop.addEventListener('click',()=>{
            
            if ( image_flag == 1 ) 
            {
                document.querySelector('.hovering-container > .img-container > div').innerHTML = "";
                document.querySelector('.hovering-container > .img-container > div').append(crop_image());
                reverse_tool();
            }
            else
            {
                document.querySelector('.hovering-container > .img-container > div').innerHTML = "";
                pop_resolution_error();
            }
            
        });

        //------>Tool Animation Display All Configs
        var timeline = null;
        
        

        function run_tool(index,image) 
        {
            uploaded_image_controller();
                
            setTimeout(() => {
                    if (flag == 1)      image_flag=1; 
                    else if(flag == -1) image_flag=-1;
                          
                    image_validate(index,image);
                }, 2100);
                
                console.log('finish');
        }

        function pop_tool(index,image) 
        {
            timeline=gsap.timeline();
            timeline = gsap.timeline(
                {
                    default:{duration:8},
                    clearProps:true,
                    onStart:()=>   {  console.log('start'); reset_uploaded_image_controller();  document.body.style.overflow="hidden" ;  },
                    onComplete:()=>{  run_tool(index,image);  }
                }
                );

            timeline
                .fromTo('.tool-container',{x:'-1',display:"none",backdropFilter:"blur(0px)",backgroundColor:"transparent"},
                        {x:0,display:"flex",backdropFilter:"blur(5px)",backgroundColor:"rgb(255, 255, 255,0.5)",duration:1,ease:"slow"})
                .fromTo('.tool-section',{scale:0,opacity:0,x:-1},{x:0,scale:1,opacity:1,duration:1,ease:"elastic.out(0.5,0.5)"})
                .fromTo('.cropping-container',{opacity:0,x:-1},{x:0,opacity:1,duration:1,ease:"expo"},2)
                .fromTo('.from-left',{x:"-100%"},{x:0,duration:2,ease:"elastic.out(0.5,0.8)"},"<")
                .fromTo('.from_right',{x:"100%"},{x:0,duration:2,ease:"elastic.out(0.5,0.8)"},'>-2')
                .fromTo('.button',{y:"100%",scale:0},{y:0,scale:1,duration:1,stagger:0.5,ease:"elastic.out(1,1)"},"<0.1")
                .fromTo('.tool-label',{y:"-100%",opacity:0},{y:0,opacity:1,duration:1,ease:"bounce.out"},">-1.5")
                .fromTo('.intro-container',{scale:0,x:-1},{scale:1,x:0,duration:1,ease:"bounce"},"<1.5")
                .fromTo('.list',{x:"-100%",opacity:0,stagger:0},{x:0,opacity:1,duration:2,stagger:0.5,ease:"elastic.out(0.5,0.8)"},"<1")
                .fromTo('.tool-button-section > .change-picture',{x:"-100vw",scale:0},{x:0,scale:1,duration:2,ease:"elastic.out(1,0.5)"},5.5)
                .fromTo('.tool-button-section > .crop',{x:"-100vw",scale:0},{x:0,scale:1,duration:2,ease:"elastic.out(1,0.5)"},5);
                      
        }
        
        function reverse_tool() 
        {
            timeline.timeScale(3);
            timeline.reverse();
            document.body.style.overflow="unset"  ;  
        }

        //Crop Tool Error Configurations

        //---->Cancel Button
        var cancel = document.getElementsByClassName('cancel')[0];

        cancel.addEventListener('click',reverse_resolution_error);

        var resol_error = null;

        function pop_resolution_error() 
        {
            resol_error = gsap.timeline({default:{duration:3},clearProps:true});

            resol_error
                    .fromTo('.error-popup-container',{x:-1,backdropFilter:"blur(0px)",backgroundColor:"transparent",display:"none"},
                        {x:0,backdropFilter:"blur(5px)",backgroundColor:"rgb(0,0,0,0.2)",display:"flex",duration:1,ease:"ease-in"})
                    .fromTo('.error-container',{x:-1,scale:0,opacity:1,border:"none"},
                        {scale:1,opacity:1,x:0,duration:0.5,ease:"ease-in"})
                    .fromTo('.icon-container > svg',{opacity:0,rotate:"-90deg"},{rotate:0,opacity:1,duration:1,ease:"bounce.out(0.3,0.4)"})
                    .fromTo('.icon-container > svg',{y:15},{y:0,duration:0.5,repeat:-1,yoyo:true,ease:"ease-in"})
                    .fromTo('.error-text',{y:"100",opacity:0},{y:0,opacity:1,duration:1,ease:"ease-in"},1.5)
                    .fromTo('.cancel > svg',{x:-1,opacity:0,rotate:"0"},{x:0,opacity:1,rotate:"45deg",duration:0.5,ease:"slow"})
        }

        function reverse_resolution_error() 
        {
            gsap.fromTo('.error-popup-container',{display:"flex",x:0,backdropFilter:"blur(5px)",backgroundColor:"rgb(0,0,0,0.2)"},
                    {x:-1,backdropFilter:"blur(0px)",duration:0.5,backgroundColor:"transparent",display:"none"});
        }


        //----->CROP BUTTON

        function crop_image( ) 
        {
            var image = null;

            //First for Drawing Whole Image On Canvas
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');

            canvas.width  = target_image.naturalWidth;
            canvas.height = target_image.naturalHeight;
            ctx.drawImage(target_image,0,0);

            //Holding Cropped Section Dimension To BE Cropped From Full Dimensions
            var box_percentage_global = (target_image.naturalWidth / 100) * (moving_div.getBoundingClientRect().width / target_image.width * 100);
            var x =  (target_image.naturalWidth / 100) * (fetch_position_of_style_dimensions(moving_div.style.left) / target_image.width * 100) ;
            var y =  (target_image.naturalHeight / 100) * ( (fetch_position_of_style_dimensions(moving_div.style.top) - top_limit ) / target_image.height * 100) ;
            console.log("x: "+x+" y: "+y+" box: "+box_percentage_global);
            
            var cropped = ctx.getImageData(x,y,box_percentage_global,box_percentage_global);
            console.log(cropped);

            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            canvas.width  = box_percentage_global;
            canvas.height = box_percentage_global;

            ctx.putImageData(cropped,0,0);

            //canvas data converting to URL to further process or download it
            var src = canvas.toDataURL();

            //converting canvas to blob file to create one from canvas
            canvas.toBlob((blob)=>{
                image = blob;
                console.log(blob);
            },'image/png');

            return canvas;           
        }
        
        //-------> SHOW Cropped Image On Hover To File Selection Input Field
        
        var crop_again = document.querySelector('.crop-again > .crop');
        crop_again.addEventListener('click',()=>{
            pop_tool();
        });

        var appear = gsap.timeline();

        img.addEventListener('pointerover',e => 
        { 
            p=e;console.log("x: "+ e.clientX+" y: "+e.clientY);
            if ( image_flag == 1 ) 
            {
                show_cropped_section(e);
            }
        });

        document.querySelectorAll('.form-input-container > div:nth-child(1)')[2].addEventListener('pointerleave',e=>{
            appear.timeScale(3);
            appear.reverse();
        });

        var p;
        function show_cropped_section(e) 
        {
           
            //settting position according to cursor 
            document.getElementsByClassName('hovering-container')[0].style.left = (e.clientX + 10) + 'px';
            
            //animate the window now
            appear = gsap.timeline({default:{duration:1}});
            appear
                .fromTo('.hovering-container',{display:"none",opacity:0,x:-1},{x:0,opacity:1,display:"flex",duration:0.5,ease:"slow"})
        }



        //Password Validation
        var password_flag=0;
        var weak    =['bar weak-half-animation'   ,  'bar weak-full-animation'];
        var good    =['bar good-half-animation'   ,  'bar good-full-animation'];
        var strong  =['bar strong-half-animation' ,'bar strong-full-animation'];
        let animation_container = document.getElementsByClassName('flex');

        // npass.addEventListener("change",password_validate);
        npass.addEventListener("blur",password_validate);

        var password_accepted = function () 
        {
                password_flag=1;
                document.getElementById('p-' + input_names[3]).innerText = "";
                document.getElementsByClassName('mark-container')[3].innerHTML = tick;
                document.getElementsByClassName('mark-container')[3].title = "Password Accepted!";   
        }
        
        var password_anmimation = (weak_animation = "bar",good_animation = "bar",strong_animation = "bar") => 
        {
            animation_container[0].children[0].children[1].className = weak_animation;
            animation_container[0].children[1].children[1].className = good_animation;
            animation_container[0].children[2].children[1].className = strong_animation;
        } 
        
        function password_validate() 
        {
            var password_regex1=/[a-zA-Z]{1,}/;//must include one letter
            var password_regex2=/[0-9]{1,}/;
            var password_regex3=/[~!@#$%^&*()_{}`"|'/.<>,\?\]\[+=]{1,}/;
            
            if (npass.value) 
            {
                if(password_regex1.test(npass.value) && password_regex2.test(npass.value) && password_regex3.test(npass.value))
                {
                    if (npass.value.length == 8) 
                    {
                        password_accepted();
                        password_anmimation(weak[1],"bar","bar");                    
                    }
                    else if(npass.value.length > 8 && npass.value.length < 16)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[0],"bar");
                    }
                    else if(npass.value.length == 16)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[1],"bar");
                    }
                    else if(npass.value.length > 16 && npass.value.length < 32)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[1],strong[0]);
                    }
                    else if(npass.value.length >= 32)
                    {
                        password_accepted();
                        password_anmimation(weak[1],good[1],strong[1]);
                    }
                    else
                    {
                        password_flag=0;
                        password_anmimation(weak[0],"bar","bar");
                        document.getElementById('p-' + input_names[3]).innerText = "*Password must be 8 or more characters long";
                        document.getElementsByClassName('mark-container')[3].innerHTML = cross;
                        document.getElementsByClassName('mark-container')[3].title = "Password Not Accepted"; 
                    }
                }
                else
                {
                    password_flag=0;
                    password_anmimation();
                    document.getElementById('p-' + input_names[3]).innerText = "*Please use mix of letters, numbers & symbols";
                    document.getElementsByClassName('mark-container')[3].innerHTML = cross;
                    document.getElementsByClassName('mark-container')[3].title = "Password Not Accepted"; 
                }
            }
            else
            {
                password_flag=0;
                password_anmimation();
                document.getElementById('p-' + input_names[3]).innerText = "*Password Required";
                document.getElementsByClassName('mark-container')[3].innerHTML = cross;
                document.getElementsByClassName('mark-container')[3].title = "Password Not Accepted"; 
            }
        }


        //Confirming Password
        cpass.addEventListener("blur",confirm_password);
        npass.addEventListener("change",confirm_password);

        var password_equals_flag=0;
        function confirm_password() 
        {
             if(npass.value && password_flag==1)
             {
                if (cpass.value) 
                {
                    if(npass.value == cpass.value)
                    {
                        password_equals_flag=1;
                        document.getElementById('p-' + input_names[4]).innerText = "";
                        document.getElementsByClassName('mark-container')[4].innerHTML = tick;
                        document.getElementsByClassName('mark-container')[4].title = "Password Accepted!";                        
                    }
                    else
                    {
                        password_equals_flag=0;
                        document.getElementById('p-' + input_names[4]).innerText = "*This password not equal to new password";
                        document.getElementsByClassName('mark-container')[4].innerHTML = cross;
                        document.getElementsByClassName('mark-container')[4].title = "Password Not Accepted"; 
                    }
                }
                else
                {
                    password_equals_flag=0;
                    document.getElementById('p-' + input_names[4]).innerText = "*Password Confirmation Required";
                    document.getElementsByClassName('mark-container')[4].innerHTML = cross;
                    document.getElementsByClassName('mark-container')[4].title = "Password Not Accepted"; 
                }
             }  
             else
             {
                password_equals_flag=0;
                document.getElementById('p-' + input_names[4]).innerText = "*Please First Fill The New Password Field";
                document.getElementsByClassName('mark-container')[4].innerHTML = cross;
                document.getElementsByClassName('mark-container')[4].title = "Password Not Accepted"; 
             }
        }

        //username validation
        username_flag = 0;
        uname.addEventListener('blur',username_validate);

        function username_validate() 
        {
            // username must have atleast 1 numbers and 4 letters 
            var username_regex1 = /[a-zA-Z]{1,}/g;
            var username_regex2 = /[0-9]{1,}/;

            if(uname.value)
            {
                if(username_regex1.test(uname.value) && username_regex2.test(uname.value))
                {
                    if(uname.value.length >= 5)
                    {
                        username_flag = 1;
                        document.getElementById('p-' + input_names[0]).innerText = "";
                        document.getElementsByClassName('mark-container')[0].innerHTML = tick;
                        document.getElementsByClassName('mark-container')[0].title = "Username Accepted";
                    }
                    else
                    {
                        username_flag=0;
                        document.getElementById('p-' + input_names[0]).innerText = "*Username must be 5 or more characters long";
                        document.getElementsByClassName('mark-container')[0].innerHTML = cross;
                        document.getElementsByClassName('mark-container')[0].title = "Username Not Accepted"; 
                    }
                }
                else
                {
                    username_flag=0;
                    document.getElementById('p-' + input_names[0]).innerText = "*Username must include numbers and letters";
                    document.getElementsByClassName('mark-container')[0].innerHTML = cross;
                    document.getElementsByClassName('mark-container')[0].title = "Username Not Accepted"; 
                }
            }
            else
            {
                username_flag=0;
                document.getElementById('p-' + input_names[0]).innerText = "*Username Required";
                document.getElementsByClassName('mark-container')[0].innerHTML = cross;
                document.getElementsByClassName('mark-container')[0].title = "Username Not Accepted"; 
            }
        }

        //Email Vaildation
        email_flag = 0;

        mail.addEventListener('blur',email_validate);

        function email_validate() 
        {
            // /((^[a-zA-Z]{0,}[0-9]{1,}[a-zA-Z0-9]{0,}@gmail.com))/g.exec('muhammadrao1246@gmail.com')
            //|(^.{0,}[a-zA-Z]{3,}.{0,}@gmail.com$)
            var email_regex1 = /(^[a-zA-Z0-9]{0,}[0-9]{1,}[a-zA-Z0-9]{0,})/g; //for to have atleast 1 number
            var email_regex2 = /(^.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,}[a-zA-Z]{1,}.{0,})/g; //for to have atleast 3 characters
            var email_regex3 = /(@.{1,}.com$)/g;

            if (mail.value) 
            {
                if ( email_regex1.test(mail.value) && email_regex2.test(mail.value) ) 
                {
                    if ( email_regex3.test(mail.value) ) 
                    {
                        email_flag=1;
                        document.getElementById('p-' + input_names[1]).innerText = ""; 
                        document.getElementsByClassName('mark-container')[1].innerHTML = tick;
                        document.getElementsByClassName('mark-container')[1].title = "Email Accepted";                        
                    } 
                    else 
                    {
                        email_flag=0;
                        document.getElementById('p-' + input_names[1]).innerText = "*Email must end with '@[domain].com'";
                        document.getElementsByClassName('mark-container')[1].innerHTML = cross;
                        document.getElementsByClassName('mark-container')[1].title = "Email Not Accepted";                      
                    }                   
                } 
                else 
                {
                    email_flag=0;
                    document.getElementById('p-' + input_names[1]).innerText = "*Email must contain atleast 3 letters and 1 number";
                    document.getElementsByClassName('mark-container')[1].innerHTML = cross;
                    document.getElementsByClassName('mark-container')[1].title = "Email Not Accepted";                   
                }
            } 
            else 
            {
                email_flag=0;
                document.getElementById('p-' + input_names[1]).innerText = "*Email Required";
                document.getElementsByClassName('mark-container')[1].innerHTML = cross;
                document.getElementsByClassName('mark-container')[1].title = "Email Not Accepted";                
            }
        }
        


        function validate_all() 
        {
            if (email_flag == username_flag == image_flag == password_equals_flag == password_flag == 1) 
            {
                return true;    
            } 
            else 
            {
                //run all self validation functions to validate all form at once
                validate_images  ();
                password_validate();
                confirm_password ();
                username_validate();
                email_validate   ();

                return false;
            }
            
        }


        //Event Listeners For Page Icon
        document.getElementById("games-section").onmouseover = function() 
        {

            document.getElementsByClassName('icon')[0].style.visibility = "hidden";
        };

        document.getElementById("games-section").onmouseout = function() 
        {
            document.getElementsByClassName('icon')[0].style.visibility = "visible";
        };
   