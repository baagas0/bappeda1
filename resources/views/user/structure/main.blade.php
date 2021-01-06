<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>{{ env('APP_NAME', 'BAPPEDA') }}</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{ asset('frontend/structure/style.css') }}">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="body genealogy-body genealogy-scroll">
    <div class="genealogy-tree">
        <ul>
            <li>
                <a href="javascript:void(0);">
                    <div class="member-view-box">
                        <div class="member-image">
                            <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                            <div class="member-details">
                                <h3>Bunyamin</h3>
                            </div>
                        </div>
                    </div>
                </a>
                <ul class="active">
                    @foreach($menu as $menu)
                    <li>
                        <a href="javascript:void(0);">
                            <div class="member-view-box">
                                <div class="member-image">
                                    <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                    <div class="member-details">
                                        <h3>{{ $menu->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul >
                            <?php
                                $sub = DB::table('structures')
                                    ->where('parent_id',$menu ->id)
                                    ->get();
                            ?>
                            @foreach($sub as $row)
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image">
                                            <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                            <div class="member-details">
                                                <h3>{{ $row->name }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul >
                                    <?php
                                        $sub1 = DB::table('structures')
                                            ->where('parent_id',$row ->id)
                                            ->get();
                                    ?>
                                    @foreach($sub1 as $row1)
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="member-view-box">
                                                <div class="member-image">
                                                    <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                                    <div class="member-details">
                                                        <h3>{{ $row1->name }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <ul >
                                            <?php
                                                $sub2 = DB::table('structures')
                                                    ->where('parent_id',$row1 ->id)
                                                    ->get();
                                            ?>
                                            @foreach($sub2 as $row2)
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="member-view-box">
                                                        <div class="member-image">
                                                            <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                                            <div class="member-details">
                                                                <h3>{{ $row2->name }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <ul >
                                                    <?php
                                                        $sub3 = DB::table('structures')
                                                            ->where('parent_id',$row2->id)
                                                            ->get();
                                                    ?>
                                                    @foreach($sub3 as $row3)
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <div class="member-view-box">
                                                                <div class="member-image">
                                                                    <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                                                    <div class="member-details">
                                                                        <h3>{{ $row3->name }}</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script><script  src="{{ asset('frontend/structure/script.js') }}"></script>

</body>
</html>
