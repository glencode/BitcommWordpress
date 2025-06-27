# Custom Post Types Population Guide

This guide explains how to populate and update all Custom Post Types (CPTs) in your WordPress site with realistic content and professional images from Unsplash.

## Available Custom Post Types

Your site includes the following custom post types:

1. **Services** (`itsulu_service`) - IT services offered by the company
2. **Why Choose Us** (`why_choose_us`) - Reasons why clients should choose your company
3. **Testimonials** (`testimonial`) - Client testimonials with ratings and photos
4. **Awards** (`award`) - Company awards and recognitions
5. **Team Members** (`team_member`) - Staff profiles with photos and positions
6. **Solutions** (`itsulu_solution`) - Business solutions offered
7. **Portfolio** (`portfolio`) - Showcase of completed projects
8. **Approach Items** (`approach_item`) - Company methodology and process steps
9. **Solution Requests** (`solution_request`) - Client inquiry submissions

## Scripts Included

### 1. `populate-cpts.php` - Create New Content

This script creates fresh content for all custom post types with:
- Professional, realistic content
- High-quality images from Unsplash
- Proper meta fields and custom field data
- SEO-friendly titles and descriptions

### 2. `update-existing-cpts.php` - Update Existing Content

This script finds and updates existing posts that contain:
- Lorem ipsum text
- Placeholder content
- Empty or generic content
- Missing images or meta data

## How to Use

### Method 1: Direct Browser Access

1. **To populate with new content:**
   ```
   http://yoursite.com/wp-content/themes/your-theme/populate-cpts.php?populate=true
   ```

2. **To update existing content:**
   ```
   http://yoursite.com/wp-content/themes/your-theme/update-existing-cpts.php?update=true
   ```

### Method 2: WordPress Admin (Recommended)

1. Log into your WordPress admin dashboard
2. Go to **Tools > File Manager** (if available) or use FTP
3. Navigate to the theme directory
4. Run the scripts by accessing the URLs above

### Method 3: Command Line (Advanced)

If you have WP-CLI installed:

```bash
# Navigate to your WordPress root directory
cd /path/to/your/wordpress

# Run the population script
wp eval-file wp-content/themes/your-theme/populate-cpts.php

# Run the update script
wp eval-file wp-content/themes/your-theme/update-existing-cpts.php
```

## What Gets Created/Updated

### Services (6 items)
- Web Development
- Mobile App Development
- Cloud Solutions
- Digital Marketing
- Cybersecurity
- Data Analytics

### Why Choose Us (6 items)
- Expert Team
- 24/7 Support
- Proven Track Record
- Cost-Effective Solutions
- Agile Methodology
- Security First

### Testimonials (6 items)
- Client testimonials with 5-star ratings
- Professional client photos
- Company names and positions
- Realistic testimonial content

### Awards (4 items)
- Best IT Company 2023
- Innovation Award 2023
- Customer Choice Award
- Top Employer 2023

### Team Members (6 items)
- CEO, CTO, Head of Development
- UX/UI Design Lead
- Cybersecurity Specialist
- Project Manager

### Solutions (6 items)
- Enterprise Resource Planning (ERP)
- Customer Relationship Management (CRM)
- E-commerce Platform
- Business Intelligence Dashboard
- Cloud Migration Services
- Mobile Workforce Management

### Portfolio (6 items)
- FinTech Mobile App
- E-commerce Marketplace
- Healthcare Management System
- Real Estate Platform
- Educational Learning Platform
- Supply Chain Management

### Approach Items (5 items)
- Discovery & Planning
- Design & Prototyping
- Development & Testing
- Deployment & Launch
- Support & Maintenance

## Image Sources

All images are sourced from Unsplash.com with proper licensing:
- Professional business photos
- Technology and IT-related imagery
- High-quality portraits for team members and testimonials
- Modern, clean aesthetic matching IT company branding

## Safety Features

### The scripts include safety measures:
- **No duplicate content**: Won't create duplicate posts
- **Preserve existing images**: Won't replace existing featured images
- **Backup recommended**: Always backup your database before running
- **Selective updates**: Only updates posts with placeholder content

## Customization

You can customize the content by editing the arrays in the PHP files:

1. **Services content**: Edit the `$services` array in `populate-cpts.php`
2. **Testimonials**: Modify the `$testimonials` array
3. **Team members**: Update the `$team_members` array
4. **Images**: Replace Unsplash URLs with your own image URLs

## Troubleshooting

### Common Issues:

1. **Permission errors**: Ensure your web server has write permissions to the uploads directory
2. **Memory limits**: Large image downloads may require increased PHP memory limit
3. **Timeout issues**: For large datasets, consider running scripts in smaller batches

### Error Messages:

- **"Cannot download image"**: Check internet connection and Unsplash URL accessibility
- **"Permission denied"**: Verify file permissions and WordPress user capabilities
- **"Post creation failed"**: Check for required fields and post type registration

## Best Practices

1. **Backup first**: Always backup your database before running population scripts
2. **Test environment**: Run scripts on a staging site first
3. **Review content**: Check the populated content and adjust as needed
4. **SEO optimization**: Review and optimize titles and descriptions for SEO
5. **Image optimization**: Consider compressing images for better performance

## Post-Population Tasks

### After running the scripts:

1. **Review content**: Check all populated posts in WordPress admin
2. **Customize as needed**: Edit any content to match your specific business
3. **Set up menus**: Add new content to navigation menus
4. **Configure widgets**: Update widgets to display new content
5. **Test functionality**: Ensure all custom fields and meta data work correctly

## Support

If you encounter issues:

1. Check WordPress error logs
2. Verify custom post type registrations
3. Ensure all required plugins are active
4. Test with a minimal theme to isolate issues

## File Structure

```
theme-directory/
├── populate-cpts.php          # Main population script
├── update-existing-cpts.php   # Update existing content script
├── CPT-POPULATION-README.md   # This documentation
├── functions.php              # Contains CPT registrations
└── inc/
    └── custom-post-types.php  # Additional CPT definitions
```

## Security Notes

- Scripts check for WordPress environment before execution
- Nonce verification for admin actions
- Sanitized input and output
- No direct file access allowed
- Proper capability checks

---

**Note**: These scripts are designed to work with the existing custom post type structure in your theme. If you've modified the CPT registrations, you may need to adjust the scripts accordingly.