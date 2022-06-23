<?php
return [
    'confirmButtonText'=>'ok , I know',
    'searchButton'=>'جستجو',
    'exitButtonText'=>'خروج',
    'loginButtonText'=>'ورود',
    'confrimExitButtonText'=>'ایا مایل به خروج هستید?',
    'placeholderSearch'=>'کد پیگیری',
    'abute_me'=>'درباره ما',
    'contact_me'=>'تماس با ما',
    'homePage'=>'صفحه اصلی',

    'textUserEditButton'=>'ویرایش کاربر',
    'textHomeButton'=>'داشبورد',
    'textEditButton'=>'edit',
    'hedearMenu'=>[
        0=>[
            ['href'=>'',
            'text'=>'',
            'style'=>'margin-left: 150px;',
            'class'=>''
           ],
            ['href'=>'https://thaholding.com/%d9%86%d9%85%d8%a7%db%8c%d9%86%d8%af%da%af%db%8c-%d8%a8%db%8c%d9%85%d9%87/',
             'text'=>'نمایندگی بیمه',
             'style'=>'',
             'class'=>'a-tag my-auto'
            ],
            ['href'=>'https://thaholding.com/contact-us/',
             'text'=>'تماس با ما',
             'style'=>'',
             'class'=>'a-tag my-auto'
            ],
            ['href'=>'https://thaholding.com/about-us-3/',
             'text'=>'درباره ما',
             'style'=>'',
             'class'=>'a-tag my-auto'
            ],
            ['href'=> route('login'),
             'text'=>'ورود به پنل',
             'style'=>'',
             'class'=>'a-tag my-auto btn btn-primary text-white'
            ],
        ],
        1=>[
            ['href'=>'https://thaholding.com/#Home',
            'text'=>'صفحه اصلی',
            'style'=>'',
            'class'=>'a-tag2 my-auto'
           ],
           ['href'=>'https://thaholding.com/%d8%aa%d8%af%d8%a8%db%8c%d8%b1-%d8%aa%d8%b1%d8%a7%d8%a8%d8%b1-%d8%ae%d9%84%db%8c%d8%ac-%d9%81%d8%a7%d8%b1%d8%b3/',
            'text'=>'تدبیر ترابر خلیج فارس',
            'style'=>'',
            'class'=>'a-tag2 my-auto'
           ],
           ['href'=>'https://thaholding.com/%d9%87%d9%85%db%8c%d8%a7%d8%b1-%d8%ad%d9%85%d9%84-%d9%87%d8%b1%d9%85%d8%b2%da%af%d8%a7%d9%86/',
            'text'=>'همیار حمل و نقل',
            'style'=>'',
            'class'=>'a-tag2 my-auto'
           ],
           ['href'=>'https://thaholding.com/%d8%a2%d8%b1%d8%a7%d9%86-%d9%87%d9%85%db%8c%d8%a7%d8%b1-%d8%a7%db%8c%d8%b1%d8%a7%d9%86%db%8c%d8%a7%d9%86/',
            'text'=>'آران همیار ایرانیان',
            'style'=>'',
            'class'=>'a-tag2 my-auto'
           ],
        ]
    ],


    'textpublicUser'=>'کاربر عمومی',



    //users page
    'userspage'=>[
        'placeholderSearch'=>'نام کاربری/نام و نام خانوادگی',
        'selectFirstOpsion'=>'انتخاب سطح دسترسی',
        'confrimActiveUserButtonText'=>'آیا میخواهید این کاربر را فعال کنید؟',
        'confrimDisActiveUserButtonText'=>'آیا میخواهید این کاربر را غیر فعال کنید؟',
        'ActiveUserButtonText'=>'فعال',
        'DisActiveUserButtonText'=>'غیرفعال',
        // tables item
        'table'=>[
            'row'=>'ردیف',
            'username'=>'نام کاربری',
            'firstname'=>'نام و نام خانوادگی',
            'userType'=>'نوع کاربر',
            'userStatus'=>'وضعیت کاربر',
        ],
        //end tables item
    ],
    //end users page

    //userَ Access Page
    'userَAccessPage'=>[
        'textAdduserAccessButton'=>'ایجاد سطح دسترسی جدید',
        'textEditButton'=>'edit',

        // tables item
        'table'=>[
            'row'=>'ردیف',
            'access'=>'سطح دسترسی',
            'homePage'=>'صفحه اصلی',
            ''=>'',
        ],
        //end tables item
    ],
    //end userَ Access Page
    //add userَ Access Page
    'addUserَAccessPage'=>[
        'textAdduserAccessButton'=>'ایجاد سطح دسترسی جدید',
        'textEditButton'=>'edit',
        "selectFirstOpsion"=> "انتخاب صفحه اصلی",
        "accessName"=> "نام دسترسی را وارد کنید",
        'confrimAddUserAccess'=>'آیا مایل به اضافه کردن این سطح دسترسی هستید؟',
        'titleUseraccessPage'=>'دسترسی ورود به صفحات',
        'titleListReciveSmsInUseraccessPage'=>'مشاهده و دریافت پیامک از دسته بندی ها',
        'titleColorInUseraccessPage'=>'colors',
        'titleListChooseCategoryInUseraccessPage'=>'لیست انتخابی دسته بندی ها',
        'backButton'=>'بازگشت',
        'addButton'=>'ایجاد',


    ],
    //end add user Access Page

    //add user Access Page
    'editUserَAccessPage'=>[
        'textAdduserAccessButton'=>'ایجاد سطح دسترسی جدید',
        'textEditButton'=>'edit',
        "selectFirstOpsion"=> "انتخاب صفحه اصلی",
        "accessName"=> "نام دسترسی را وارد کنید",
        'confrimUpdateUserAccess'=>'آیا مایل به ویرایش این سطح دسترسی هستید؟',
        'titleUseraccessPage'=>'دسترسی ورود به صفحات',
        'titleListReciveSmsInUseraccessPage'=>'مشاهده و دریافت پیامک از دسته بندی ها',
        'titleColorInUseraccessPage'=>'colors',
        'titleListChooseCategoryInUseraccessPage'=>'لیست انتخابی دسته بندی ها',
        'backButton'=>'بازگشت',
        'addButton'=>'ثبت و ویرایش',

    ],
    //end edit user Access Page

    //add user page
    'addUserPage'=>[
        'title'=>'ثبت کاربر جدید',
        'usertype'=>'نوع کاربر',
        'firstname'=>'نام و نام خانوادگی',
        'username'=>'نام کاربری',
        'natoinalcode'=>'کد ملی',
        'phone'=>'شماره موبایل',
        'password'=>'رمز عبور',
        'confrimPassword'=>'تکرار رمز عبور',
        'reciveSms'=>'دریافت پیامک',
        'backButton'=>'بازگشت',
        'addButton'=>'ثبت',
        'selectFirstOpsion'=>'انتخاب سطح دسترسی',
        'confrimAddButtonText'=>'آیا مایل به اضافه کردن این کاربر هستید؟',

    ],
    //end add user page

    //new Message Page
    'newMessagePage'=>[
        'title'=>'ثبت کاربر جدید',
        'firstname'=>'نام و نام خانوادگی',
        'natoinalcode'=>'کد ملی',
        'phone'=>'شماره تماس ',
        'orderSubject'=>'عنوان درخواست',
        'BodyMessage'=>'شرح درخواست',
        'titleUploadFile'=>'بارگذاری فایل',
        'onUploadFile'=>'درحال آپلود این فایل',
        'onUpload'=>'در حال آپلود...',
        'UploadSuccess'=>'آپلود موفقیت آمیز بود',
        'deletFile'=>' حذف فایل',
        'titleUploadVoice'=>'بارگذاری پیام صوتی',
        'onUploadVoice'=>'درحال آپلود این صدا',
        'deleteVoice'=>'حذف صدا',
        'backButton'=>'بازگشت',
        'addButton'=>'ثبت',
        'Necessary'=>'ضروری',
        'capchaError'=>'لطفا کپچا را حل کنید.',
        'selectFirstOpsion'=>'انتخاب کنید',
        'confrimAddButtonText'=>'ایا مایل به ثبت این درخواست هستید؟',

    ],
    //end new Message Page

    //edit user page
    'editUserPage'=>[
        'title'=>'ویرایش اطلاعات کاربر',
        'username'=>'نام کاربری',
        'natoinalcode'=>'کد ملی',
        'usertype'=>'نوع کاربر',
        'firstname'=>'نام و نام خانوادگی',
        'phone'=>'شماره موبایل',
        'password'=>'رمز عبور جدید',
        'confrimPassword'=>'تکرار رمز عبور جدید',
        'reciveSms'=>'دریافت پیامک',
        'backButton'=>'بازگشت',
        'editButton'=>'ثبت تغییرات',
        'selectFirstOpsion'=>'انتخاب سطح دسترسی',
        'confrimEditButtonText'=>'آیا میخواهید اطلاعات را ویرایش کنید؟',

    ],
    //end edit user page

    //tickets page
    'ticketsPage'=>[
        'title'=>'پیگیری درخواست',
        'placeholderShowFromCode'=>"جهت مشاهده مشاهده درخواست را وارد نمایید",
        'ShowFromCodeButton'=>'بررسی  کد رهگیری',
        'placeholderSearch'=>'نوشتن قسمتی از نام و نام خانوادگی',
        'typestatus'=>[
            '0'=>'همه درخواست ها',
            '1'=>'در انتظار پاسخ',
            '2'=>'مشاهده شده',
            '3'=>'پاسخ داده شده',
            '4'=>'بسته شده',
        ],
        'searchButton'=>'جستجو',
        'table'=>[
            'row'=>'ردیف',
            'subject'=>'موضوع',
            'nameSender'=>'نام ارسال کننده',
            'code'=>'کد پیگیری',
            'Status'=>'وضعیت',
            'countChat'=>'تعداد چت',
            ''=>'',
        ],
        'showButton'=>'مشاهده',


    ],
    //end tickets page



    //show ticket page
    'showTicketPage'=>[
        'title'=>'درخواست شماره ',
        'typestatus'=>[
            '0'=>'در انتظار پاسخ',
            '1'=>'مشاهده شده',
            '2'=>'پاسخ داده شده',
            '-1'=>'بسته شده',
        ],
        'table'=>[
            'subject'=>'موضوع',
            'nameSender'=>'نام ارسال کننده',
            'code'=>'کد ملی',
            'Status'=>'وضعیت',
            'countChat'=>'تعداد چت',
        ],
        'downloadFile'=>'فایل پیوست',
        'BodyMessage'=>'شرح درخواست',
        'titleUploadFile'=>'بارگذاری فایل',
        'onUploadFile'=>'درحال آپلود این فایل',
        'onUpload'=>'در حال آپلود...',
        'UploadSuccess'=>'آپلود موفقیت آمیز بود',
        'deletFile'=>' حذف فایل',
        'titleUploadVoice'=>'بارگذاری پیام صوتی',
        'onUploadVoice'=>'درحال آپلود این صدا',
        'deleteVoice'=>'حذف صدا',
        'backButton'=>'بازگشت',
        'addButton'=>'ثبت',
        'Necessary'=>'ضروری',
        'capchaError'=>'لطفا کپچا را حل کنید.',
        'selectFirstOpsion'=>'انتخاب کنید',
        'confrimAddButtonText'=>'ایا مایل به ثبت این پاسخ هستید؟',

    ],
    //end show ticket page

    //Upload file JS Blade
    'UFJ'=>[
        'server_error'=>'مشکل در ارتباط با سرور',
        'tryDeleteAudio'=>'تلاش برای حذف این صدا',
        'audio'=>'صدا',
        'file'=>'فایل',
        'uploaded'=>'آپلود گشت',
        'audioError'=>'شما قادر به حذف این صدا نیستید',
        'deletedAudio'=>'صدا حذف گشت',
        'uploading'=>'در حال آپلود',
        'fileError'=>'شما قادر به حذف این فایل نیستید',
        'deletedFile'=>'فایل حذف گشت',
        ''=>'',
        ''=>'',
        ''=>'',
        ''=>'',
        'tryDeleteFile'=>'تلاش برای حذف این فایل',
    ],
    //End Upload file JS Blade




    //subjects page
    'subjectsPage'=>[
        'placeholderAddbox'=>'موضوع جدید',
        'addbutton'=>"ثبت",
        'ShowFromCodeButton'=>'بررسی  کد رهگیری',
        'confrimAddButtonText'=>'آیا مایل به اضافه کردن این موضوع هستید؟',
        'confrimdeleteButtonText'=>'آیا مایل به حذف کردن این موضوع هستید؟',
        'table'=>[
            'row'=>'ردیف',
            'subject'=>'موضوع',
            ''=>'',
        ],
        'deletButton'=>'حذف',

    ],
    //end subjects page


    'publicpage'=>[
        "dashbord"=> "داشبورد اصلی",
        "tickets"=> "پیگیری ها",
        "showticket"=> "مشاهده درخواست",
        "addticket"=> "ثبت درخواست",
        "uploadfile"=> "آپلود فایل",
        "deletefile"=> "حذف فایل",
        "answer"=> "حذف فایل",
        "QueueSMS"=>"ارسال صف پیامک",
    ],
    'allpage'=>[
        "dashbord"=> "داشبورد اصلی",
        "tickets"=> "پیگیری ها",
        "addticket"=> "ثبت درخواست",
        "users"=>"لیست کاربران",
         "adduser"=>"اضافه کردن کاربر",
         "editprofile"=>"ویرایش پروفایل",
         "changeoderuser"=>"ویرایش دیگر کاربران",
         "allmessages"=>"مشاهده همه پیام ها",
         "answerforalluser"=>"پاسخ به کاربران",
         "answer"=>"پاسخ",
         "activeuser"=>"فعال کردن کاربر",
         "useraccess"=>"سطح دسترسی",
         "adduseraccess"=>"اضافه کردن سطح دسترسی",
         "edituseraccess"=>"ویرایش کردن سطح دسترسی",
         "subjectorders"=>"دسته موضوعات",
         "addsubjectorder"=>"اضافه کردن موضوع جدید",
         "deletesuborder"=>"حذف موضوع ",
         "cancelMessage"=>"بستن تیکت",
    ],
    'dashborditem'=>[
        'addticket'=>['images/add.png','ثبت درخواست','در صورت داشتن درخواست و نیاز به هر گونه راهنمایی روی ثبت درخواست کلیک نمایید.'],
        'tickets'=>['images/pygir.png','پیگیری ها','جهت پیگیری درخواست های ارسالی'],
        'users'=>['images/users.png','لیست  کاربران','مشاهده و ویرایش کاربران '],
        'adduser'=>['images/addusers.png','اضافه کردن کاربر','ثبت یک کاربر جدید با سطح دسترسی مورد نظر'],
        'useraccess'=>['images/access.png','سطح دسترسی','مشاهده سطح دسترسی ها  ایجاد و ویرایش سطح دسترسی برای کاربران مختلف'],
        'subjectorders'=>['images/suborder.png','دسته موضوعات','مشاهده لیست موضوعات همراه با امکان اضافه و حذف موضوع در پنل'],

    ],

    'colors'=>[
        'startheader'=>['startheader','شروع هدر','#d3aa42'],
        'endheader'=>['endheader','پایان هدر','#faf4e7'],
    ],


];
