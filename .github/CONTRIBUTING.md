# Contributing to Datatype

Thank you for your interest in contributing to the `datatype` package! This PHP library provides a fluent, extensible API for managing various data structures, and we welcome contributions to enhance its functionality, fix issues, or improve documentation. This guide explains how to fork the repository, set up the project, make changes, and submit pull requests (PRs`) to contribute.

## Getting Started
The `datatype` package is hosted on GitHub at [php-repos/datatype](https://github.com/php-repos/datatype). Before contributing, please read the [README.md](README.md) for an overview and the [API.md](API.md) for detailed function and method documentation.

### Prerequisites
- PHP 8.2 or higher.
- `phpkg` package manager (see [PHPkg Documentation](https://phpkg.com/) for setup).
- Git installed on your system.
- A GitHub account for forking and submitting PRs.

## How to Contribute
Follow these steps to contribute to the `datatype` package:

### 1. Fork the Repository
1. Navigate to [github.com/php-repos/datatype](https://github.com/php-repos/datatype).
2. Click the **Fork** button in the top-right corner to create a copy of the repository under your GitHub account.
3. Clone your forked repository to your local machine:
   ```bash
   git clone https://github.com/your-username/datatype.git
   cd datatype
   ```

### 2. Set Up the Project
1. Navigate to the project root:
   ```bash
   cd datatype
   ```
2. Install dependencies using `phpkg`:
   ```bash
   phpkg install
   ```
3. The project is now set up and ready for development.

### 3. Create a Branch
Create a new branch for your changes:
```bash
git checkout -b feature/your-feature-name
```
Use descriptive branch names, e.g., `feature/add-set-contains`, `fix/map-validation`, or `docs/update-api`.

### 4. Make Changes
- **Code Changes**:
    - Modify or add code in the appropriate component (`Arr`, `Collection`, `Map`, `Str`, `Text`).
    - Follow the package’s coding style:
        - Use snake_case for function and method names.
        - Include PHPDoc blocks with descriptions, parameters, return types, and examples.
        - Ensure UTF-8 support for string operations.
- Example: Adding a `contains` method to `Set`:
  ```php
  /**
   * Checks if a value exists in the set.
   *
   * @param mixed $value The value to check.
   * @return bool True if the value exists, false otherwise.
   * @example
   * ```php
   * $set = new Set([1, 2, 3]);
   * $exists = $set->contains(2); // Returns true
   *```
  */
  public function contains(mixed $value): bool
  {
      return has($this->items, fn (mixed $item) => $this->are_equal($item, $value));
  }
  ```
- **Tests**:
    - Add or update tests in the `tests` directory.
    - To run all tests:
        1. Build the project:
           ```bash
           phpkg build
           ```
        2. Navigate to the development build directory:
           ```bash
           cd builds/development
           ```
        3. Run tests using the test runner:
           ```bash
           phpkg run https://github.com/php-repos/test-runner.git
           ```
    - To run a specific test (replace `TheFilename` with the test file or class name):
      ```bash
      phpkg run https://github.com/php-repos/test-runner.git run --filter=TheFilename
      ```
    - Ensure tests cover new features, bug fixes, and edge cases.
- **Documentation**:
    - Update [API.md](API.md) for new or modified functions/methods.
    - Add changelog entries in [CHANGELOG.md](CHANGELOG.md) under an `Unreleased` section:
      ```markdown
      ## [Unreleased]
  
      ### Added
      - Added `contains` method to `Set` for checking value existence.
      ```

### 5. Commit Changes
Commit your changes with a clear, descriptive message:
```bash
git add .
git commit -m "Add contains method to Set with tests and documentation"
```

### 6. Push to Your Fork
Push your branch to your forked repository:
```bash
git push origin feature/your-feature-name
```

### 7. Submit a Pull Request
1. Go to your forked repository on GitHub (e.g., `github.com/your-username/datatype`).
2. Click the **Compare & pull request** button for your branch.
3. Set the base repository to `php-repos/datatype` and the base branch to `main`.
4. Write a clear PR description:
    - Explain the purpose of your changes (e.g., new feature, bug fix).
    - Reference any related issues (e.g., `Fixes #123`).
    - Mention updates to tests or documentation.
    - Example:
      ```
      ## Description
      Adds a `contains` method to the `Set` class to check for value existence. Includes unit tests and updates to `API.md` and `CHANGELOG.md`.
 
      ## Changes
      - Added `Set::contains` method.
      - Added tests in `tests/SetTest.php`.
      - Updated `API.md` and `CHANGELOG.md`.
 
      Closes #123
      ```
5. Submit the PR and wait for review. Respond to feedback from maintainers.

## Contribution Guidelines
To ensure smooth collaboration, please follow these guidelines:

- **Code Quality**:
    - Write clean, readable code adhering to PSR-12 standards.
    - Use snake_case for function and method names, matching the package’s convention.
    - Ensure compatibility with PHP 8.2+ and `mbstring` for UTF-8 support.
- **Testing**:
    - Include unit tests for all new features and bug fixes.
    - Ensure tests pass using the test runner commands above.
    - Cover edge cases, such as empty inputs or invalid types.
- **Documentation**:
    - Add or update PHPDoc blocks with descriptions, parameters, return types, and examples.
    - Update [API.md](../API.md) for API changes.
    - Add changelog entries in [CHANGELOG.md](../CHANGELOG.md).
- **Commit Messages**:
    - Use clear, concise messages (e.g., `Fix Map constructor validation`, `Add Set::contains method`).
    - Reference issues or PRs where relevant.
- **Scope of Changes**:
    - Keep PRs focused on a single feature or fix.
    - Discuss major changes (e.g., new components) in an issue before submitting a PR.

## Reporting Issues
If you find a bug or have a feature request:
1. Check the [GitHub Issues](https://github.com/php-repos/datatype/issues) page for existing reports.
2. Open a new issue with:
    - A clear title and description.
    - Steps to reproduce (for bugs).
    - Expected and actual behavior.
    - Environment details (PHP version, `phpkg` version).
3. Use labels (e.g., `bug`, `enhancement`) to categorize the issue.

## Discussing Changes
For major changes or questions:
- Open a discussion in the [GitHub Discussions](https://github.com/php-repos/datatype/discussions) tab.
- Or, comment on a related issue to propose ideas.

## Code of Conduct
Please adhere to the [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/version/2/0/code_of_conduct/) to ensure a welcoming and inclusive community.

## License
By contributing, you agree that your contributions will be licensed under the MIT License, as specified in the [LICENSE](../LICENSE).

## Questions?
If you have questions or need help, open an issue or start a discussion on GitHub. We’re excited to collaborate with you!