
// import {  } from "crop.js";
// var file= new File(2048,'muhammad.txt');
        //Class Declaration for tick & cross
        var tick = "fas fa-check marker marker-green";
        var cross = "fas fa-plus marker marker-red";

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
        // export{image_flag};
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
                            // image_flag=1;
                            // document.getElementById('p-' + input_names[2]).innerText = "";
                            // document.getElementById('i-' + input_names[2]).className = tick;
                            // document.getElementById('i-' + input_names[2]).title = "Image Selected";
                            
                            pop_tool();


                            image_flag.onchange=
                            function()
                            {
                                if ( image_flag == 1 ) 
                                {
                                    document.getElementById('p-' + input_names[2]).innerText = "";
                                    document.getElementById('i-' + input_names[2]).className = tick;
                                    document.getElementById('i-' + input_names[2]).title = "Image Selected";
                                }
                                else
                                {
                                    //Popup for resolution
                                }
                            };
                            

                        } 
                        else 
                        {
                            image_flag=-1;
                            document.getElementById('p-' + input_names[2]).innerText = "*Image size must be less than 5MB(5120KB)";
                            document.getElementById('i-' + input_names[2]).className = cross;
                            document.getElementById('i-' + input_names[2]).title = "Image Not Selected";
                        }
                    }
                    else
                    {
                        image_flag=-1;
                        document.getElementById('p-' + input_names[2]).innerText = "*Selected file must type of .png .jpg .jpeg .ico";
                        document.getElementById('i-' + input_names[2]).className = cross;
                        document.getElementById('i-' + input_names[2]).title = "Image Not Selected";
                    }
                } 
                else
                {
                    document.getElementById('p-' + input_names[2]).innerText = "";
                    document.getElementById('i-' + input_names[2]).className = "";
                    document.getElementById('i-' + input_names[2]).title = "";
                }
            }
            if (image.length==0) 
            {
                image_count=0;
                image_flag=-1;
                document.getElementById('p-' + input_names[2]).innerText = "*Profile Picture Is Required";
                document.getElementById('i-' + input_names[2]).className = cross;
                document.getElementById('i-' + input_names[2]).title = "Image Not Selected";  
            }
        }

        //Cropping Tool Window Config
        var change_picture = document.getElementsByClassName('change-picture')[0];
        var crop = document.getElementsByClassName('crop')[0];
        var timeline = "";
        
        crop.addEventListener('click',reverse_tool);

        function run_tool() 
        {
                image_flag=uploaded_image_controller();
                console.log('finish');
        }

        function pop_tool() 
        {
            timeline=gsap.timeline();
            timeline = gsap.timeline({default:{duration:8},onStart:()=>{console.log('start');},onComplete:()=>{run_tool();}});

            timeline
                .fromTo('.tool-container',{x:'-1',display:"none",backdropFilter:"blur(0px)",backgroundColor:"transparent"},
                        {x:0,display:"flex",backdropFilter:"blur(5px)",backgroundColor:"rgb(255, 255, 255,0.5)",duration:2,ease:"slow"})
                .from('.tool-section',{scale:0,opacity:0,duration:3,ease:"elastic.out(1,1)"})
                .from('.cropping-container',{opacity:0,duration:1,ease:"expo"},3)
                .from('.from-left',{x:"-100%",duration:2,ease:"elastic.out(0.5,0.8)"},"<")
                .from('.from_right',{x:"100%",duration:2,ease:"elastic.out(0.5,0.8)"},'>-2')
                .fromTo('.button',{y:"100%",scale:0},{y:0,scale:1,duration:1,stagger:0.5,ease:"elastic.out(1,1)"},"<0.1")
                .from('.tool-label',{y:"-100%",opacity:0,duration:1,ease:"bounce.out"},">-1.5")
                .from('.intro-container',{scale:0,duration:1,ease:"bounce"},"<1.5")
                .from('.list',{x:"-100%",opacity:0,duration:2,stagger:0.5,ease:"elastic.out(0.5,0.8)"},"<1")
                .fromTo('.change-picture',{x:"-100vw",scale:0},{x:0,scale:1,duration:2,ease:"elastic.out(1,0.5)"},5.5)
                .fromTo('.crop',{x:"-100vw",scale:0},{x:0,scale:1,duration:2,ease:"elastic.out(1,0.5)"},5);
                      
        }
        
        function reverse_tool() 
        {
            timeline.timeScale(3);
            timeline.reverse();
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
                document.getElementById('i-' + input_names[3]).className = tick;
                document.getElementById('i-' + input_names[3]).title= "Password Accepted!";   
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
                        document.getElementById('i-' + input_names[3]).className = cross;
                        document.getElementById('i-' + input_names[3]).title = "Password Not Accepted";
                    }
                }
                else
                {
                    password_flag=0;
                    password_anmimation();
                    document.getElementById('p-' + input_names[3]).innerText = "*Please use mix of letters, numbers & symbols";
                    document.getElementById('i-' + input_names[3]).className = cross;
                    document.getElementById('i-' + input_names[3]).title = "Password Not Accepted";
                }
            }
            else
            {
                password_flag=0;
                password_anmimation();
                document.getElementById('p-' + input_names[3]).innerText = "*Password Required";
                document.getElementById('i-' + input_names[3]).className = cross;
                document.getElementById('i-' + input_names[3]).title = "Password Not Accepted";
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
                        document.getElementById('i-' + input_names[4]).className = tick;
                        document.getElementById('i-' + input_names[4]).title= "Password Accepted!";                        
                    }
                    else
                    {
                        password_equals_flag=0;
                        document.getElementById('p-' + input_names[4]).innerText = "*This password not equal to new password";
                        document.getElementById('i-' + input_names[4]).className = cross;
                        document.getElementById('i-' + input_names[4]).title = "Password Not Accepted";
                    }
                }
                else
                {
                    password_equals_flag=0;
                    document.getElementById('p-' + input_names[4]).innerText = "*Password Confirmation Required";
                    document.getElementById('i-' + input_names[4]).className = cross;
                    document.getElementById('i-' + input_names[4]).title = "Password Not Accepted";
                }
             }  
             else
             {
                password_equals_flag=0;
                document.getElementById('p-' + input_names[4]).innerText = "*Please First Fill The New Password Field";
                document.getElementById('i-' + input_names[4]).className = cross;
                document.getElementById('i-' + input_names[4]).title = "Password Not Accepted";
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
                        document.getElementById('i-' + input_names[0]).className = tick;
                        document.getElementById('i-' + input_names[0]).title = "Username Accepted";
                    }
                    else
                    {
                        username_flag=0;
                        document.getElementById('p-' + input_names[0]).innerText = "*Username must be 5 or more characters long";
                        document.getElementById('i-' + input_names[0]).className = cross;
                        document.getElementById('i-' + input_names[0]).title = "Username Not Accepted";
                    }
                }
                else
                {
                    username_flag=0;
                    document.getElementById('p-' + input_names[0]).innerText = "*Username must include numbers and letters";
                    document.getElementById('i-' + input_names[0]).className = cross;
                    document.getElementById('i-' + input_names[0]).title = "Username Not Accepted";
                }
            }
            else
            {
                username_flag=0;
                document.getElementById('p-' + input_names[0]).innerText = "*Username Required";
                document.getElementById('i-' + input_names[0]).className = cross;
                document.getElementById('i-' + input_names[0]).title = "Username Not Accepted";
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
                        document.getElementById('i-' + input_names[1]).className = tick;
                        document.getElementById('i-' + input_names[1]).title = "Email Accepted";                         
                    } 
                    else 
                    {
                        email_flag=0;
                        document.getElementById('p-' + input_names[1]).innerText = "*Email must end with '@[domain].com'";
                        document.getElementById('i-' + input_names[1]).className = cross;
                        document.getElementById('i-' + input_names[1]).title = "Email Not Accepted";                         
                    }                   
                } 
                else 
                {
                    email_flag=0;
                    document.getElementById('p-' + input_names[1]).innerText = "*Email must contain atleast 3 letters and 1 number";
                    document.getElementById('i-' + input_names[1]).className = cross;
                    document.getElementById('i-' + input_names[1]).title = "Email Not Accepted";                    
                }
            } 
            else 
            {
                email_flag=0;
                document.getElementById('p-' + input_names[1]).innerText = "*Email Required";
                document.getElementById('i-' + input_names[1]).className = cross;
                document.getElementById('i-' + input_names[1]).title = "Email Not Accepted";                
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
   