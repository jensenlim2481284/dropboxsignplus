<script>

new Chartist.Line('.ct-chart', {
  labels: [
    @foreach($dailyRevenue as $revenue)
      "{{$revenue->date}}",
    @endforeach
  ],
  series: [
    [
      @foreach($dailyRevenue as $revenue)
      "{{$revenue->sum}}",
      @endforeach


    ]
  ]
}, {
  showArea: true,
  showLine: false,
  showPoint: false,
  height: '200px',
  axisX: {
    showGrid: false
  },
   axisY: {
    showGrid: false
  },
});



new Chartist.Pie('.donut-chart', {
  @if($totalUser)
  series: [{{$totalProductSold /$totalUser * 100}},{{($totalUser - $totalProductSold) /$totalUser * 100}}]
  @else 
  series: [0,100]
  @endif
 
}, {
  donut: true,
  donutWidth: 12,
  startAngle: 270,
  total: 200,
  showLabel: false
});



</script>