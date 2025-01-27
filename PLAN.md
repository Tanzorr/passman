#### Goal and deadline (to be defined)
Ex: 
  Release a working MVP till the end of the year on a cloud platform.


### Tools
- [+] psalm - static analysis (NPR, dead code, type mismatch,...)
- [+] php-cs-fixer - formatting
- [ ] phpmd - code complexity, code smell 
- [ ] 1 simple test on PHPUnit

### Get familiar with
- [ ] Laravel
    - [+] Relations
    - [+] Migrations

### Action
- [+] Step 1. Entities, migrations  **1 branch, each point is a commit**
    - [+] Create User
    - [+] Create Vault
    - [+] Create Password
    - [+] Create SharedAccess (polymorph relation to password or vault, can have time based limit or count based limit)
    - [+] Create a Pull Request and sync

- [ ] Step 2. Configuration of API for User.
    - [+] list (with pagination)
    - [+] get
    - [+] post (create)
    - [+] put (update) (put requires full payload, patch can go with partial payload)

- [+] Step 3. Configure Vault and Password API.
    - One vault **hasMany** passwords
    - One password **belongsToOne** vault
    - User hasMany vaults
    - Vault belongsToOne User   

- [+] Step 4. Configure SharedAccess API
    - User hasMany SharedAcesses (as host)
    - User hasMany SharedAccess (as guest)
    - SharedAccess hasMany Vaults (host can give access to many vaults to one or more guests)
    - Vault belongsToMany SharedAcesses (vault can be shared multiple times)
    - [ ] add global scopes for vaults and passwords
        ```
            # in middlewhere if(!user->Admin) {...add global scope}
            # OR Vault::boot()
            Vault::addGlobalScope(...) # where user_id=X
            Vault::addGlobalScope('scopeByOwnership')# where user_id=X

            Vault::all() # SELECT * from vaults where user_id = X
            Vault::find(5) # null
        ```
    - [ ] polymorphic relation to vault OR password
    https://laravel.com/docs/11.x/eloquent-relationships#custom-polymorphic-types
    ```
    access{
        host: User,
        guest: User,
        accessible: Morph<Password|Vault> # accessible_id, accessible_type -> password/vault
        exprirationDate: ?DateTime
    }
    ```
 
- [ ] Step 5. Auth, JWT, Rate limmit, IP based access

- [ ] Step 6. ACL - access control layer (Roles and permission)
    - [ ] Scopes: https://laravel.com/docs/11.x/eloquent#query-scopes

- [ ] Step 7. Mailhog and mail sending (SharedAccess should be activated only if it was accepted though an email)

- [ ] Step 8. Infrastructure
    - [ ] Github CI/CD
        - [ ] setup minimal machine on AWS (EC2 instance from free tier)
        - [ ] write a github deploy pipeline that will:
            - build
                - [ ] install php dependencies
                - [ ] cache:warmup
                - [ ] set env variables 
                - [ ] compress and send to S3 (aws-cli)
            - deploy
                - [ ] copy from S3 to EC2 instance and unpack (aws-cli)
                - [ ] start docker containers on EC2 machine (aws cli)
        - [ ] CI/CD for front
    - [ ] Deployment to AWS
    - [ ] infrastructure with terraform

- [ ] Step 8. To be discussed
    - [ ] Push notifications

### Stuff I would like to learn
 - [ ] Configre CI/CD on github (on PR run tests, code quality check)
 - [ ] configure xdebuger with docker
 - [ ] configure nginx and php-fpm containers for current project
 - [ ] Discuss gitflow, create releases, tags and integrate it with Github CI/CD
 - [ ] Get familiar with AWS
    - [ ] EC2
        - [ ] Security groups
        - [ ] VPC
    - [ ] S3
    - [ ] RDS
    - [ ] CloudWatch
    - [ ] Parameter Store
    - [ ] CodeBuild + CodePipeline
    - [ ] Fargate


### Tech debt approaches
- [ ] interfaces
- [ ] packages
- [ ] BC
- [ ] ...

### Extra quest
- [ ] Entities
    - [ ] Order entity
    - [ ] Order item entity
    - [ ] Product entity
- [ ] Relations
- [ ] Aggrrgations
    - [ ] by price
    - [ ] by amount
    - [ ] amount by period
    - [ ] by product per period
- [ ] Search:
    - [ ] by product
    - [ ] by user
- [ ] Import of products
- [ ] Export of products






