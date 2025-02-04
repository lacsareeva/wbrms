import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/index.css',
                'resources/css/registerStyle.css',
                'resources/css/DashboardStyle.css',
                'resources/css/DBcontentStyle.css',
                'resources/css/AnnouncementStyle.css',
                'resources/css/reportStyles.css',
                'resources/css/blotterStyles.css',
                'resources/css/borrowedStyle.css',
                'resources/css/account.css',
                'resources/css/profile.css',
                'resources/css/resident.css',
                'resources/css/recordStyles.css',
                'resources/css/recordCertificate.css',
                'resources/js/records.js',
                'resources/js/ResidentAndOfficials.js',
                'resources/js/profile.js',
                'resources/js/account.js',
                'resources/js/borrowed.js',
                'resources/js/blotter.js',
                'resources/js/report.js',
                'resources/js/Announcement.js',
                'resources/js/app.js',
                'resources/js/DBscript.js',
                'resources/js/ResidentScripts/dashboardScripts.js',
                'resources/js/ResidentScripts/residentScripts.js',
                'resources/css/ResidentStyles/dashboardStyle.css',
                'resources/css/ResidentStyles/AnnouncementStyles.css',
                'resources/css/ResidentStyles/brgyOfficials.css',
                'resources/css/ResidentStyles/registerStyle.css',
                'resources/css/ResidentStyles/loginStyle.css',
                'resources/js/ResidentScripts/announcementScripts.js',
                'resources/js/ResidentScripts/blotterScripts.js',
                'resources/js/ResidentScripts/borrowedScripts.js',
                'resources/js/ResidentScripts/recordScripts.js',
                'resources/js/ResidentScripts/reportScripts.js',
                'resources/js/ResidentScripts/profileScripts.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                { src: 'resources/image', dest: '' }, // Copies to public/images
            ],
        }),
    ],
});
