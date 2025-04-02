<?php

namespace App\Interface\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MakeEntityCommand extends Command
{
    protected $signature = 'make:entity {name : The name of the entity}';
    protected $description = 'Create a new entity with all necessary structure';

    public function handle()
    {
        $name = $this->argument('name');

        $directories = [
            "app/Domain/{$name}",
            "app/Domain/{$name}/Actions",
            "app/Domain/{$name}/DTOs",
            "app/Domain/{$name}/Events",
            "app/Domain/{$name}/Exceptions",
            "app/Domain/{$name}/Listeners",
            "app/Domain/{$name}/Models",
            "app/Domain/{$name}/Repositories",
            "app/Domain/{$name}/Services",
            "app/Domain/{$name}/ValueObjects",
            "app/Application/{$name}",
            "app/Infrastructure/{$name}",
            "app/Infrastructure/{$name}/Repositories",
        ];

        // Create directories
        foreach ($directories as $directory) {
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true);
                $this->info("Directory created: {$directory}");
            }
        }

        // Create model
        $this->createModel($name);

        // Create repository files
        $this->createRepository($name);

        // Create service files
        $this->createService($name);

        // Create DTO files
        $this->createDTO($name);

        $this->info("Entity {$name} created successfully!");
    }

    protected function createModel($name)
    {
        $modelPath = "app/Domain/{$name}/Models/{$name}.php";
        $content = '<?php

namespace App\Domain\\' . $name . '\\Models;

use Illuminate\Database\Eloquent\Model;

class ' . $name . ' extends Model
{
    protected $fillable = [
        // Add your fillable attributes here
    ];
}';

        File::put($modelPath, $content);
        $this->info("Model created: {$modelPath}");
    }

    protected function createRepository($name)
    {
        // Interface
        $interfacePath = "app/Domain/{$name}/Repositories/{$name}RepositoryInterface.php";
        $interfaceContent = '<?php

namespace App\Domain\\' . $name . '\\Repositories;

interface ' . $name . 'RepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}';

        File::put($interfacePath, $interfaceContent);
        $this->info("Repository Interface created: {$interfacePath}");

        // Repository Implementation (in Domain layer)
        $domainRepoPath = "app/Domain/{$name}/Repositories/{$name}Repository.php";
        $domainRepoContent = '<?php

namespace App\Domain\\' . $name . '\\Repositories;

use App\Domain\\' . $name . '\\Models\\' . $name . ';

/**
 * Abstract repository class that defines the contract
 * This keeps the domain layer independent from infrastructure details
 */
abstract class ' . $name . 'Repository implements ' . $name . 'RepositoryInterface
{
    protected $model;

    public function __construct(' . $name . ' $model)
    {
        $this->model = $model;
    }

    abstract public function all();
    abstract public function find($id);
    abstract public function create(array $data);
    abstract public function update($id, array $data);
    abstract public function delete($id);
}';

        File::put($domainRepoPath, $domainRepoContent);
        $this->info("Domain Repository created: {$domainRepoPath}");

        // Infrastructure Implementation (specific adapter)
        $implPath = "app/Infrastructure/{$name}/Repositories/Eloquent{$name}Repository.php";
        $implContent = '<?php

namespace App\Infrastructure\\' . $name . '\\Repositories;

use App\Domain\\' . $name . '\\Models\\' . $name . ';
use App\Domain\\' . $name . '\\Repositories\\' . $name . 'Repository;

class Eloquent' . $name . 'Repository extends ' . $name . 'Repository
{
    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}';

        File::put($implPath, $implContent);
        $this->info("Infrastructure Repository Implementation created: {$implPath}");
    }

    protected function createService($name)
    {
        $servicePath = "app/Domain/{$name}/Services/{$name}Service.php";
        $serviceContent = '<?php

namespace App\Domain\\' . $name . '\\Services;

use App\Domain\\' . $name . '\\Repositories\\' . $name . 'RepositoryInterface;

class ' . $name . 'Service
{
    protected $repository;

    public function __construct(' . $name . 'RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}';

        File::put($servicePath, $serviceContent);
        $this->info("Service created: {$servicePath}");
    }

    protected function createDTO($name)
    {
        $dtoPath = "app/Domain/{$name}/DTOs/{$name}DTO.php";
        $dtoContent = '<?php

namespace App\Domain\\' . $name . '\\DTOs;

class ' . $name . 'DTO
{
    // Define your attributes

    public function __construct(array $data)
    {
        // Map data to DTO attributes
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        // Convert DTO to array
        return [
            // Return attributes
        ];
    }
}';

        File::put($dtoPath, $dtoContent);
        $this->info("DTO created: {$dtoPath}");
    }
}
