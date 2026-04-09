@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
 

const chartData = @json($chartData);

// ✅ Ensure numbers are treated as numbers
const totalSpent = chartData.reduce((sum, item) => sum + Number(item.spent), 0);

const ctx = document.getElementById('expenseChart');

if (ctx) {

    // ✅ Center text plugin (fixed)
    const centerTextPlugin = {
        id: 'centerText',
        beforeDraw(chart) {
            const { width, height, ctx } = chart;

            ctx.save(); // ✅ always save first

            const fontSize = (height / 140).toFixed(2);
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'center';

             const text = '₦' + totalSpent.toLocaleString();
            
            const subText = 'Total Spent';

            // Main text
            ctx.font = `${fontSize}em sans-serif`;
            ctx.fillStyle = '#ffffff';
            ctx.fillText(text, width / 2, height / 2 - 10);

            // Sub text
            ctx.font = `${fontSize * 0.6}em sans-serif`;
            ctx.fillStyle = '#9ca3af';
            ctx.fillText(subText, width / 2, height / 2 + 15);

            ctx.restore(); // ✅ restore after drawing
        }
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: chartData.map(i => i.name),
            datasets: [{
                data: chartData.map(i => Number(i.spent)),
                backgroundColor: chartData.map(i => {
                    switch(i.color){
                        case 'green': return '#22c55e';
                        case 'red': return '#ef4444';
                        case 'blue': return '#3b82f6';
                        case 'purple': return '#8b5cf6';
                        case 'pink': return '#ec4899';
                        case 'cyan': return '#06b6d4';
                        case 'yellow': return '#f59e0b';
                        default: return '#3b82f6';
                    }
                }),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,              // ✅ important
            maintainAspectRatio: false,    // ✅ important
            cutout: '75%',                 // nicer look
            plugins: {
                legend: { display: false }
            }
        },
        plugins: [centerTextPlugin] // 🔥 THIS WAS MISSING
    });
}
</script>
@endpush