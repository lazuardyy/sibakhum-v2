const chart = new Chartisan({
  el: '#chart',
  url: "@chart('FakultasChart')",
  loader: {
    color: '#ff00ff',
    size: [30, 30],
    type: 'bar',
    textColor: '#ffff00',
    text: 'Loading some chart data...',
  },
});
