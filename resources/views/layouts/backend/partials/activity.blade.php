<div class="sb-slidebar sb-right sb-style-overlay">
    <div class="right-bar slimscroll">
        <span class="r-close-btn sb-close"><i class="fa fa-times"></i></span>

        <ul class="nav nav-tabs nav-justified-">
            <li class="">
                <a href="#activity" class="active" data-toggle="tab">Activity</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="activity">
                <div class="aside-widget">
                    <?php use App\Helpers\Activity; ?>
                    
                    <div class="side-title-alt">
                        <h2>Log Aktifitas</h2>
                    </div>
                    @foreach(Activity::list() as $log)
                    <ul class="team-list chat-list-side info">
                        <li>
                            <span class="thumb-small">
                                <i class="fa fa-pencil"></i>
                            </span>
                            <div class="inline">
                                <span class="name">{{ $log->page }}</span>
                                <span class="time">{{ $log->description }}</span>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>