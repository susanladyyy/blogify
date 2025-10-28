# Nex Digital / Goodcommerce

## Fullstack Developer Test

### Blog Platform with Content Importer

---

## **Objective**

Build a simple blog platform that can import content from external APIs.  
Show us your approach to API integration and data transformation.

## **Time Estimate**

This task should not take more than 4 hours.

---

## **Requirements**

### **Blog Features**

- Blog posts with: `title`, `content`, `status` (draft/published), `source`, `external_id`
- Admin panel to manage posts
- Public page to view published posts

### **Import Functionality**

- Import from **JSONPlaceholder API** — random blog post
- Import from **FakeStore API** — random product (transform to blog post)
- Single item import per execution
- Duplicate prevention
- Imported posts saved as drafts

### **APIs**

- **JSONPlaceholder**: `https://jsonplaceholder.typicode.com/posts/{randomId}`
- **FakeStore API**: `https://fakestoreapi.com/products/{randomId}`

---

## **The Challenge**

Transform two different data structures into consistent blog posts.

### **JSONPlaceholder Post Example**

```json
{
  "id": 1,
  "title": "blog post title", 
  "body": "blog post content"
}
```

### **FakeStore Product Example**

```json
{
  "id": 1,
  "title": "Product Name",
  "description": "Product description",
  "price": 109.95,
  "category": "product category"
}
```

Both should be transformed into blog posts in your system.

---

## **Setup**

```bash
git clone [repository]
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## **Submission**

## Submission Instructions

1. Use this repository template
2. Build your solution
3. Commit with meaningful messages
4. Submit your repository URL for us to review
5. Include in your submission:
    - Total time spent: 3 hours and 50 minutes
    - Explain your approach: firstly i created all the necessary models, then i go over to the controller and i finished the features for admin first, then i continued the features for image imports
    - Explain how you would add a new API Source:
Modify the handle method in ImportPostCommand (the console command created)
I'd write the specific code to call the new API's URL and manually "transform" its unique data, (for example, mapping post.body to my content field).

    - Propose improvement to your own code: 
The weakness of the current ImportPostCommand is that it's doing too much. It knows the specific URLs and data structures for every API, which is hard to maintain. I would propose a better approach is to refactor this using the Strategy Pattern, creating separate "Importer" classes for each API where each class has one job that is to import from its source. Then, the main command's only responsibility is to randomly pick one of these importer classes to run. This will be more scalable if there is a new API to be added as the importer.
---

## **Evaluation Focus**

- Problem-solving approach
- Code quality and structure
- User experience
- Commit history

Show us how you think.

---

## **Closing Note**

We look forward to reviewing your solution and seeing how you approach real-world API integration challenges.
