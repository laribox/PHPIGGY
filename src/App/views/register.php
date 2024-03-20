<?php include $this->resolve("partials/_header.php"); ?>

<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">

  <form method="POST" class="grid grid-cols-1 gap-6">
    <!-- Email -->
    <label class="block">
      <span class="text-gray-700">Email address</span>
      <input name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com" value="<?php echo $oldFormData['email'] ?? '' ?>" />
      <?php if (array_key_exists('email', $errors)) {
        foreach ($errors['email'] as $error) {
          echo "<span class='text-red-500'>{$error}</span>";
          echo "<br>";
        }
      }  ?>
    </label>
    <!-- Age -->
    <label class="block">
      <span class="text-gray-700">Age</span>
      <input name="age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" value="<?php echo $oldFormData['age'] ?? '' ?>" />
      <?php if (array_key_exists('age', $errors)) {
        foreach ($errors['age'] as $error) {
          echo "<span class='text-red-500'>{$error}</span>";
          echo "<br>";
        }
      }  ?>
    </label>
    <!-- Country -->
    <label class="block">
      <span class="text-gray-700">Country</span>
      <select name="country" id="country" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option value="USA">USA</option>
        <option value="Canada" <?php echo $oldFormData['country'] === 'Canada' ? 'selected' : ''  ?>>Canada</option>
        <option value="Mexico" <?php echo $oldFormData['country'] === 'Canada' ? 'selected' : ''  ?>>Mexico</option>
        <option value="Invalid">Invalid Country</option>
      </select>
    </label>
    <!-- Social Media URL -->
    <label class="block">
      <span class="text-gray-700">Social Media URL</span>
      <input name="socialMediaURL" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" value="<?php echo $oldFormData['socialMediaURL'] ?? '' ?>" />
      <?php if (array_key_exists('socialMediaURL', $errors)) {
        foreach ($errors['socialMediaURL'] as $error) {
          echo "<span class='text-red-500'>{$error}</span>";
          echo "<br>";
        }
      }  ?>
    </label>
    <!-- Password -->
    <label class="block">
      <span class="text-gray-700">Password</span>
      <input name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
      <?php if (array_key_exists('password', $errors)) {
        foreach ($errors['password'] as $error) {
          echo "<span class='text-red-500'>{$error}</span>";
          echo "<br>";
        }
      }  ?>
    </label>
    <!-- Confirm Password -->
    <label class="block">
      <span class="text-gray-700">Confirm Password</span>
      <input name="confirmPassword" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
      <?php if (array_key_exists('confirmPassword', $errors)) {
        foreach ($errors['confirmPassword'] as $error) {
          echo "<span class='text-red-500'>{$error}</span>";
          echo "<br>";
        }
      }  ?>
    </label>
    <!-- Terms of Service -->
    <div class="block">
      <div class="mt-2">
        <div>
          <label class="inline-flex items-center">
            <input name="tos" id="tos" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" type="checkbox" />
            <span class="ml-2">I accept the terms of service.</span>
            <?php if (array_key_exists('tos', $errors)) {
              foreach ($errors['tos'] as $error) {
                echo "<span class='text-red-500'>{$error}</span>";
                echo "<br>";
              }
            }  ?>
          </label>
        </div>
      </div>
    </div>
    <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
      Submit
    </button>
  </form>
</section>


<?php include $this->resolve("partials/_footer.php"); ?>