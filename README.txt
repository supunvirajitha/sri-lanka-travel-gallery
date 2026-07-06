TravelLK PHP Project - Admin Only Upload Gallery

How to run:
1. Copy this folder to C:\xampp\htdocs\
2. Rename folder to sri-lanka-travel
3. Start Apache in XAMPP
4. Open http://localhost/sri-lanka-travel/

Admin login:
URL: http://localhost/sri-lanka-travel/admin-login.php
Username: admin
Password: admin123

Admin features:
- Admin login
- Admin dashboard
- Admin-only image upload
- Admin can view and delete uploaded images
- Uploaded images save into uploads/travel/
- Image details save into storage/gallery.json

User/public features:
- Users can view Home, Places, Gallery, About, Contact
- Users can view more images on place details page
- Users cannot upload images
- Public upload.php redirects to admin login

Important:
- Change admin username/password in includes/auth.php
- Make sure storage/ and uploads/travel/ folders are writable
- Replace placeholder images inside assets/images/ with your real images


Latest change:
- Public gallery now displays admin-uploaded images inside one small modern frame.
- Users can click Next/Previous or thumbnails to view images.
- Admin dashboard uploaded image previews are smaller.


Gallery Next Button Fix:
- gallery.php now contains its own fixed slider JavaScript.
- Next/Previous buttons use unique IDs and classes.
- The gallery displays all static and admin-uploaded images in one small frame.

Latest update:
- Admin can delete uploaded images directly from gallery.php when logged in.
- Normal users can only view gallery images.
- Static images from includes/data.php cannot be deleted from gallery because they are project assets.
- Gallery image frame now uses object-fit: contain to show the full image without cropping.
- Added View Full Image link under the gallery frame.

Latest update:
- Gallery frame now auto-adjusts to each image's natural/default aspect ratio.
- Full image is shown without cropping.
- Landscape images use a wide frame.
- Portrait images stay smaller and centered.
- Description box has more space below the image.

Latest update:
- Removed black background from gallery image frame.
- Gallery frame now uses a clean white background.
- Full image is visible without cropping.
- Dark overlay removed from gallery image.

Latest update:
- Public gallery now shows ONLY admin-uploaded images.
- Static/manual gallery images from data.php have been removed from public gallery sliders.
- Admin-uploaded images display as cover images in gallery.
- Gallery automatically moves to next image every 4 seconds.
- Home page cover automatically rotates admin-uploaded images.
- Places and details pages use latest admin-uploaded image when available.
