<div id="demo" class="pdfOrder" >
    <h1>hello</h1>
    <h1>hello</h1>
    <h1>hello</h1>
    <h1>hello</h1>
    <h1>hello</h1>
</div>

<button onclick="downloadPDF()">下载</button>

<script crossorigin="anonymous" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" src="https://lib.baomitu.com/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdn.bootcss.com/html2canvas/0.5.0-beta4/html2canvas.js"></script>


<script>
    function  downloadPDF () {
        const pdf = new window.jsPDF('', 'pt', 'a4')
        let orderList = document.getElementsByClassName('pdfOrder')
        for (let i = 0, len = orderList.length; i < len; i++) {
            let target = orderList[i]
            target.style.background = '#FFFFFF'
            // 经调试，55%的时候内容显示效果比较好，与模板内容样式也有关系，自己调节一下比较好
            target.style.width = '55%'
            pdf.addHTML(target, function () {
                if (i < len - 1) {
                    pdf.addPage()
                }
                if (i === len - 1) {
                    pdf.save('PDF存档.pdf')
                }
            })
        }
    }

</script>
