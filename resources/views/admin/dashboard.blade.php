<x-app-layout>
    <div class="az-content az-content-dashboard-eight">
        <div class="container d-block">
            <h2 class="az-content-title tx-24 mg-b-5">@lang('locale.hi_welcomeback')</h2>
            <p class="mg-b-20 mg-lg-b-10">@lang('locale.manage_app', ['param'=>config('app.name', 'Laravel')])</p>
            <div class="row row-sm">
                <div class="col-md-3 mx-auto mb-2">
                    <a class="btn btn-warning btn-block" title="@lang('locale.daily_report')" data-target="#dailyreport" data-toggle="modal">
                        <i class="typcn icon typcn-filter"></i> @lang('locale.daily_report')
                    </a>
                </div>
                <div class="col-12 mb-2">
                    <div class="row row-sm">
                        <div class="col-sm-6">
                            <div class="card card-dashboard-twenty" style="border-bottom: 1.5px solid #ffc107">
                                <div class="card-body">
                                    <label class="az-content-label tx-13">@lang('locale.product', ['suffix'=>'s', 'prefix'=>''])</label>
                                    <div class="expansion-value">
                                        <strong>{{ $product }}</strong>
                                    </div>
                                    <div class="progress">
                                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar wd-100p bg-warning" role="progressbar"></div>
                                    </div>
                                    <div class="expansion-label">
                                        <span>TOTAL</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-dashboard-twenty" style="border-bottom: 1.5px solid #ffc107">
                                <div class="card-body">
                                    <label class="az-content-label tx-13">@lang('locale.order', ['suffix'=>'s', 'prefix'=>''])</label>
                                    <div class="expansion-value">
                                        <strong>{{ $orders->count() }}</strong>
                                        <strong>{{ moneyFormat($orders->sum('amount')) }}</strong>
                                    </div>
                                    <div class="progress">
                                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" class="progress-bar wd-100p bg-warning" role="progressbar"></div>
                                    </div>
                                    <div class="expansion-label">
                                        <span>TOTAL</span>
                                        <span class="text-uppercase">@lang('locale.sum')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isauthorize([1]))
                <div class="col-12 mg-t-5">
                    <div class="card card-dashboard-twenty ht-md-100p">
                        <div class="card-body">
                            <h6 class="az-content-label tx-13 mg-b-5">
                                @lang('locale.order', ['suffix'=>'s', 'prefix'=>app()->getLocale() == 'en' ? 'The' : 'Les'])
                            </h6>
                            <p class="mg-b-25">@lang('locale.order_statistic').</p>
                            <div class="chartjs-wrapper">
                                {{-- <canvas id="chartBar6"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-daily-report></x-daily-report>
    @push('scripts')
    <script src="{{ asset('lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('js/azia.js') }}"></script>
    {{-- <script src="{{ asset('js/chart.flot.sampledata.js') }}"></script> --}}

    <script>
        $(function(){
            'use strict'

            // var ctx6 = document.getElementById('chartBar6').getContext('2d');
            // new Chart(ctx6, {
            //     type: 'bar',
            //     data: {
            //         labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            //         datasets: [
            //             {
            //                 data: [150,110,90,115,125,160,160,140,100,110,120,120],
            //                 backgroundColor: '#2b91fe'
            //             },
            //             {
            //                 data: [180,140,120,135,155,170,180,150,140,150,130,130],
            //                 backgroundColor: '#054790'
            //             }
            //         ]
            //     },
            //     options: {
            //         maintainAspectRatio: false,
            //         legend: { display: false, labels: { display: false } },
            //         scales: {
            //             xAxes: [{
            //                 //stacked: true,
            //                 display: false,
            //                 barPercentage: 0.5,
            //                 ticks: {
            //                     beginAtZero:true,
            //                     fontSize: 11
            //                 }
            //             }],
            //             yAxes: [{
            //                 ticks: {
            //                 fontSize: 10,
            //                 color: '#eee',
            //                 min: 80,
            //                 max: 200
            //                 }
            //             }]
            //         }
            //     }
            // });

            // Progress
            var prog1 = $('#progressBar1 .progress-bar:first-child');
            prog1.css('width','30%');
            prog1.attr('aria-valuenow','30');
            prog1.text('30%');

            var prog2 = $('#progressBar1 .progress-bar:last-child');
            prog2.css('width','53%');
            prog2.attr('aria-valuenow', '53');
            prog2.text('53%');

            // Progress
            var prog3 = $('#progressBar2 .progress-bar:first-child');
            prog3.css('width','35%');
            prog3.attr('aria-valuenow','35');
            prog3.text('35%');

            var prog4 = $('#progressBar2 .progress-bar:last-child');
            prog4.css('width','37%');
            prog4.attr('aria-valuenow', '37');
            prog4.text('37%');

        });
    </script>  
    @endpush
</x-app-layout>
