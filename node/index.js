
var domtoimage =  require('dom-to-image-more');
const jsdom = require("jsdom");
const fs = require('fs');
const path = require('path');
const html2canvas = require('html2canvas');




const { JSDOM } = jsdom;
const dom = new JSDOM(`<!DOCTYPE html><p id="myElement">Hello world</p>`);
window = dom.window;
document = window.document;

const htmlElement = document.getElementById('myElement'); // 获取要转换的 HTML 元素

html2canvas(htmlElement).then((canvas) => {
    // 将 Canvas 图像转换为数据 URL
    const dataURL = canvas.toDataURL('image/png');

    // 将数据 URL 写入本地文件
    fs.writeFile('myCanvasImage.png', dataURL, (err) => {
        if (err) {
            console.error(err);
        } else {
            console.log('Canvas image saved to myCanvasImage.png');
        }
    });
});