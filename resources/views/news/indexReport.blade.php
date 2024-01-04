@extends('crudbooster::admin_template')
@section('content')

<head>
    <style>
        .user-block .username,
        .user-block .description,
        .user-block .comment {
            margin-left: 0px !important;
        }

        .carousel-inner>.item>a>img,
        .carousel-inner>.item>img,
        .img-responsive,
        .thumbnail a>img,
        .thumbnail>img {
            height: 500px;
            width: 100%;
        }
        .view {
            text-decoration: none; /* ลบขีดเส้นใต้ข้อความลิงค์ */
            color: #039dab; /* สีของข้อความลิงค์ */
        }

        .view:hover {
            text-decoration: none; /* เพิ่มขีดเส้นใต้ข้อความลิงค์เมื่อนำเมาส์ hover ไปที่ลิงค์ */
            color: #039dab;
        }
    </style>
</head>


<body>
    <div class="col-md-12">
        @foreach($getNewsApprove as $news)
        @php \Carbon\Carbon::setLocale('th'); @endphp
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <span class="username">คุณ {{ $news->firstName }} {{ $news->lastName }}</span>
                    <span class="description">เผยแพร่ข่าวสารเมื่อ - {{ \Carbon\Carbon::parse($news->Created_at)->diffForHumans() }}</span>
                </div>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>

            </div>

            <div class="box-body">
                @if(in_array(pathinfo($news->FileName, PATHINFO_EXTENSION), ['jpg', 'png']))
                        <img class="img-responsive pad" src="{{ asset($news->FilePath) }}" alt="Photo">
                    @endif
                <a href="/viewNews/{{ $news->id }}" target="_blank" class="view" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">
                    <p>{!! $news->TransactionDetail !!}</p>

                </a>
            </div>

        </div>
        @endforeach
    </div>
</body>
@endsection