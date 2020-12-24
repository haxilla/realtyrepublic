const puppeteer = require('puppeteer');

//have to add the no sandbox argument to 
//avoid errors with headless chrome
(async () => {
	const browser = await puppeteer.launch({headless: true, args: ['--no-sandbox']});
	const page = await browser.newPage();

	await page.goto('https://services.azre.gov/publicdatabase/DownloadLists.aspx');
	await page._client.send('Page.setDownloadBehavior', {behavior: 'allow', 
	downloadPath: '/var/www/html/larasites/realtyrepublic/app/adre/puppeteer/files/zip'})
	await page.click('#ctl00_DefaultContent_RadGridLists_ctl00__1 a');
	await page.waitFor(5000);
	await browser.close();
})();