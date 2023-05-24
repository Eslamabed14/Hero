            $table->id();
            $table->string('title');
            $table->text('desc');
            $table->string('image');
            $table->double('price');
            $table->string('ref1')->nullable();
            $table->string('ref2')->nullable();
            $table->string('ref3')->nullable();
            $table->double('pages');
            $table->double('downloads');
            $table->double('customers');
            $table->double('country');
            $table->string('b_head');
            $table->text('b_body');
            $table->string('b_image');
            $table->string('c_name');
            $table->string('c_opinion');
            $table->string('c_logo');
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('pro_cats')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();