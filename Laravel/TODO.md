# CSS Issues Fix Plan

## Issues Identified:
1. **CSS Loading Order**: Custom CSS loaded before Tailwind CSS causing override conflicts
2. **Class Conflicts**: Using both Tailwind utilities and custom CSS classes simultaneously
3. **Navigation Styling**: Potential conflicts between Tailwind navbar and custom .navbar class
4. **Inconsistent Styling**: Mix of Tailwind and custom CSS causing layout issues

## Plan:
### Step 1: Fix CSS Loading Order
- Load Tailwind CSS before custom CSS in home_layout.blade.php

### Step 2: Clean Up CSS Conflicts  
- Remove conflicting custom CSS classes that conflict with Tailwind
- Use consistent Tailwind utilities throughout
- Fix navigation styling conflicts

### Step 3: Update Landing Page Styling
- Ensure all sections use consistent Tailwind classes
- Fix hero section styling
- Clean up program cards styling

### Step 4: Test and Verify
- Check that all sections render correctly
- Verify navigation works properly
- Ensure responsive design works

## Files to Edit:
- `resources/views/layouts/home_layout.blade.php` - Fix CSS loading order
- `resources/views/home/index.blade.php` - Clean up class conflicts
- `public/css/style.css` - Remove conflicting styles

