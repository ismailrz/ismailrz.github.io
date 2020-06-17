<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(EventsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ClassifiedCategoriesTableSeeder::class);
         $this->call(BadgesTableSeeder::class);
         $this->call(EventTypesTableSeeder::class);
         $this->call(InterestGroupsTableSeeder::class);
         $this->call(JobCategoriesTableSeeder::class);
         $this->call(LanguagesTableSeeder::class);
         $this->call(PageCategoriesTableSeeder::class);
         $this->call(PostCategoriesTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(QuestionCategoriesTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(SubscriptionTypesTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
         $this->call(SkillsTableSeeder::class);
         $this->call(TagCategoriesTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(TrainingCategoriesTableSeeder::class);
         $this->call(UserTypesTableSeeder::class);
         $this->call(CountriesTableSeeder::class);
         $this->call(StatesTableSeeder::class);
         $this->call(ProfileSettingsTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(PoliciesTableSeeder::class);
         $this->call(PolicyDetailsTableSeeder::class);
         $this->call(QuestionsTableSeeder::class);
         $this->call(AnswersTableSeeder::class);
         $this->call(OrganizationsTableSeeder::class);
         $this->call(OrganizationTypesTableSeeder::class);
         $this->call(EventUsersTableSeeder::class);
         $this->call(JobsTableSeeder::class);
         $this->call(JobUsersTableSeeder::class);
         $this->call(SubscriptionTypeUserTypeTableSeeder::class);
         $this->call(SubscriptionsTableSeeder::class);
         $this->call(ProductTypeSeeder::class);
         $this->call(PartnerSeeder::class);
         $this->call(OrganizationUserSeeder::class);
         $this->call(PageSeeder::class);
         $this->call(PageUserSeeder::class);
         $this->call(ProductSeeder::class);

    }
}
