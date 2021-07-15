<?php

namespace Laravel\Nova\Tests\Browser;

use App\Models\User;
use Database\Factories\UserFactory;
use Laravel\Dusk\Browser;
use Laravel\Nova\Testing\Browser\Components\LensComponent;
use Laravel\Nova\Testing\Browser\Pages\Lens;
use Laravel\Nova\Tests\DuskTestCase;

class LensTest extends DuskTestCase
{
    /**
     * @test
     */
    public function resource_lens_can_be_viewed()
    {
        $users = User::find([1, 2, 3]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->assertSeeResource(1)
                                ->assertSeeResource(2)
                                ->assertSeeResource(3);
                    })
                    ->assertTitle('Passthrough Lens | Nova Dusk Suite');

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function can_navigate_to_detail_screen()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->click('@1-view-button');
                    })
                    ->waitForTextIn('h1', 'User Details', 25)
                    ->assertSee('User Details')
                    ->assertPathIs('/nova/resources/users/1');

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function can_navigate_to_edit_screen()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->click('@1-edit-button');
                    })
                    ->pause(1000)
                    ->assertSee('Update User')
                    ->assertPathIs('/nova/resources/users/1/edit');

            $browser->blank();
        });
    }

    /**
     * @test
     */
    // public function test_correct_select_all_matching_count_is_displayed()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->loginAs(User::find(1))
    //                 ->visit(new Lens('users', 'passthrough-lens'))
    //                 ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
    //                     $browser->waitForTable()
    //                             ->assertSelectAllMatchingCount(3)
    //                             ->click('')
    //                             ->applyFilter('Select First', '1')
    //                             ->assertSelectAllMatchingCount(1);
    //                 });
    //     });
    // }

    /**
     * @test
     */
    public function resources_can_be_sorted_by_id()
    {
        UserFactory::new()->times(50)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->assertSeeResource(1)
                                ->assertSeeResource(25)
                                ->assertDontSeeResource(26);

                        $browser->sortBy('id')
                                ->sortBy('id')
                                ->assertSeeResource(50)
                                ->assertSeeResource(30)
                                ->assertDontSeeResource(26)
                                ->assertDontSeeResource(1);
                    })->blank();

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function resources_can_be_paginated()
    {
        UserFactory::new()->times(50)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->assertSeeResource(1)
                                ->assertSeeResource(25)
                                ->assertDontSeeResource(26);

                        $browser->nextPage()
                                ->assertDontSeeResource(1)
                                ->assertDontSeeResource(25)
                                ->assertSeeResource(26)
                                ->assertSeeResource(50);

                        $browser->previousPage()
                                ->assertSeeResource(1)
                                ->assertSeeResource(25)
                                ->assertDontSeeResource(26)
                                ->assertDontSeeResource(50);
                    });

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function number_of_resources_displayed_per_page_can_be_changed()
    {
        UserFactory::new()->times(50)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->setPerPage('50')
                                ->pause(1500)
                                ->assertSeeResource(50)
                                ->assertSeeResource(25)
                                ->assertSeeResource(1);
                    });

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function number_of_resources_displayed_per_page_is_saved_in_query_params()
    {
        UserFactory::new()->times(50)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->setPerPage('50')
                                ->pause(1500)
                                ->assertSeeResource(50)
                                ->assertSeeResource(25)
                                ->assertSeeResource(1);
                    })
                    ->refresh()
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->assertSeeResource(50)
                                ->assertSeeResource(25)
                                ->assertSeeResource(1);
                    });

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function test_filters_can_be_applied_to_resources()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->applyFilter('Select First', '1')
                            ->pause(1500)
                            ->assertSeeResource(1)
                            ->assertDontSeeResource(2)
                            ->assertDontSeeResource(3)
                            ->applyFilter('Select First', '2')
                            ->pause(1500)
                            ->assertDontSeeResource(1)
                            ->assertSeeResource(2)
                            ->assertDontSeeResource(3);
                    });

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function test_filters_can_be_deselected()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                            ->applyFilter('Select First', '1')
                            ->pause(1500)
                            ->assertSeeResource(1)
                            ->assertDontSeeResource(2)
                            ->assertDontSeeResource(3)
                            ->applyFilter('Select First', '')
                            ->pause(1500)
                            ->assertSeeResource(1)
                            ->assertSeeResource(2)
                            ->assertSeeResource(3);
                    });

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function can_delete_a_resource_via_resource_table_row_delete_icon()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                                ->deleteResourceById(3)
                                ->assertSeeResource(1)
                                ->assertSeeResource(2)
                                ->assertDontSeeResource(3);
                    });

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function can_delete_resources_using_checkboxes()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                            ->clickCheckboxForId(3)
                            ->clickCheckboxForId(2)
                            ->pause(175)
                            ->deleteSelected()
                            ->assertSeeResource(1)
                            ->assertDontSeeResource(2)
                            ->assertDontSeeResource(3);
                    });

            $browser->blank();
        });
    }

    /**
     * @test
     */
    // public function can_delete_all_matching_resources()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->loginAs(User::find(1))
    //                 ->visit(new Lens('users', 'passthrough-lens'))
    //                 ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
    //                     $browser->waitForTable()
    //                         ->applyFilter('Select First', '3')
    //                         ->selectAllMatching()
    //                         ->deleteSelected()
    //                         ->applyFilter('Select First', '')
    //                         ->assertSeeResource(1)
    //                         ->assertSeeResource(2)
    //                         ->assertDontSeeResource(3);
    //                 });
    //     });
    // }

    /**
     * @test
     */
    public function can_run_actions_on_selected_resources()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                            ->clickCheckboxForId(3)
                            ->clickCheckboxForId(2)
                            ->runAction('mark-as-active');
                    });

            $this->assertEquals(0, User::find(1)->active);
            $this->assertEquals(1, User::find(2)->active);
            $this->assertEquals(1, User::find(3)->active);

            $browser->blank();
        });
    }

    /**
     * @test
     */
    public function can_run_table_row_actions_on_selected_resources()
    {
        User::whereIn('id', [2, 3, 4])->update(['active' => true]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new Lens('users', 'passthrough-lens'))
                    ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
                        $browser->waitForTable()
                            ->assertDontSeeIn('@1-row', 'Mark As Inactive')
                            ->assertSeeIn('@2-row', 'Mark As Inactive')
                            ->runInlineAction(2, 'mark-as-inactive');
                    });

            $this->assertEquals(0, User::find(1)->active);
            $this->assertEquals(0, User::find(2)->active);
            $this->assertEquals(1, User::find(3)->active);

            $browser->blank();
        });
    }

    /*
     * @test
     */
    // public function can_run_actions_on_all_matching_resources()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->loginAs(User::find(1))
    //                 ->visit(new Lens('users', 'passthrough-lens'))
    //                 ->within(new LensComponent('users', 'passthrough-lens'), function ($browser) {
    //                     $browser->waitForTable()
    //                             ->applyFilter('Select First', '2');

    //                     $browser->selectAllMatching()
    //                             ->runAction('mark-as-active');
    //                 });
    //     });

    //     $this->assertEquals(0, User::find(1)->active);
    //     $this->assertEquals(1, User::find(2)->active);
    //     $this->assertEquals(0, User::find(3)->active);
    // }
}
