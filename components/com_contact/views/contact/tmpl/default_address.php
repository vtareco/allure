<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */

//print_r($this->contact);
 
?>

	<div id="contacts-banner"><img src="images/contacts_image.jpg"/></div>
	<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>

		<?php /*if ($this->params->get('presentation_style') == 'sliders') : ?>
			<?php echo JHtml::_('bootstrap.addSlide', 'slide-contact', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc'); ?>
		<?php endif; ?>
		<?php if ($this->params->get('presentation_style') == 'tabs') : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'display-misc', JText::_('COM_CONTACT_OTHER_INFORMATION', true)); ?>
		<?php endif; ?>
		<?php if ($this->params->get('presentation_style') == 'plain'):?>
			<?php echo '<h3>'. JText::_('COM_CONTACT_OTHER_INFORMATION').'</h3>';  ?>
		<?php endif;*/ ?>

		<div class="contact-miscinfo">
			<span class="contact-misc">
				<?php echo $this->contact->misc; ?>
			</span>
		</div>

		<?php if ($this->params->get('presentation_style') == 'sliders') : ?>
			<?php echo JHtml::_('bootstrap.endSlide'); ?>
		<?php endif; ?>
		<?php if ($this->params->get('presentation_style') == 'tabs') : ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

	<?php endif; ?>


<div class="address-details">
<dl class="contact-address dl-horizontal" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"
	<?php if (($this->params->get('address_check') > 0) &&
		($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
		<?php if ($this->params->get('address_check') > 0) : ?>
			<dt>
				<span class="<?php echo $this->params->get('marker_class'); ?>" >
					<?php echo $this->params->get('marker_address'); ?>
				</span>
			</dt>
		<?php endif; ?>

		<?php if ($this->contact->address):// && $this->params->get('show_street_address')) : ?>
			<dd id="dd-address">
				<span class="col_text_1 contact-subtitle"><?php echo JText::_('COM_CONTACT_COMPANY_DETAILS'); ?></span>
				<span class="contact-street" itemprop="streetAddress">
					<?php echo $this->contact->address .'<br/>'; ?>
				</span>
			</dd>
		<?php endif; ?>
		<div id="contact-iban-bic-ttw-kvc">
		<?php if ($this->contact->iban): //&& $this->params->get('show_iban')) : ?>
			<dd>
				<span class="col_text_1 contact-subtitle"><?php echo JText::_('COM_CONTACT_IBAN'); echo': '?></span>
				<span class="contact-iban col_text_2 col_text3" itemprop="iban">
					<?php echo $this->contact->iban .'<br/>'; ?>
				</span>
			</dd>
		<?php endif; ?>
		<?php if ($this->contact->bic): //&& $this->params->get('show_bic')) : ?>
			<dd>
				<span class="col_text_1 contact-subtitle"><?php echo JText::_('COM_CONTACT_BIC'); echo': '?></span>
				<span class="contact-bic col_text_2 col_text3" itemprop="bic">
					<?php echo $this->contact->bic . '<br/>'; ?>
				</span>
			</dd>
		<?php endif; ?>
		<?php if ($this->contact->kvk_middelburg): //&& $this->params->get('show_postcode')) : ?>
			<dd>
				<span class="col_text_1 contact-subtitle"><?php echo JText::_('COM_CONTACT_KVK_MIDDELBURG'); echo': '?></span>
				<span class="contact-kvk_middelburg col_text_2 col_text3" itemprop="kvkMiddelburg">
					<?php echo $this->contact->kvk_middelburg .'<br/>'; ?>
				</span>
			</dd>
		<?php endif; ?>
		<?php if ($this->contact->btw_number): //&& $this->params->get('show_btw_number')) : ?>
		<dd>
			<span class="col_text_1 contact-subtitle"><?php echo JText::_('COM_CONTACT_BTW_NUMBER'); echo': '?></span>
			<span class="contact-btw_number col_text_2 col_text3" itemprop="btwNumber">
				<?php echo $this->contact->btw_number .'<br/>'; ?>
			</span>
		</dd>
		<?php endif; ?>
		</div>
		<div id="contact-opening-hours">
	
	<div id="header_opening_hours">
		<?php echo JText::_('COM_CONTACT_OPENING_HOURS'); echo':'?>
	</div>
	
	<div class="row_text">
		<span class="col_text_1">
			<?php echo JText::_('COM_CONTACT_MONDAY'); ?>
		</span>
		<span class="col_text_2">
			<?php echo $this->contact->monday; ?>
		</span>
	</div>

	<div class="row_text">
		<span class="col_text_1">
			<?php echo JText::_('COM_CONTACT_TUESDAY'); ?>
		</span>
		<span class="col_text_2">
			<?php echo $this->contact->tuesday; ?>
		</span>
	</div>
	
	<div class="row_text">
		<span class="col_text_1">
			<?php echo JText::_('COM_CONTACT_WEDNESDAY'); ?>
		</span>
		<span class="col_text_2">
			<?php echo $this->contact->wednesday; ?>
		</span>
	</div>
		
	<div class="row_text">
		<span class="col_text_1">
			<?php echo JText::_('COM_CONTACT_THURSDAY'); ?>
		</span>
		<span class="col_text_2">
			<?php echo $this->contact->thursday; ?>
		</span>
	</div>
			
	<div class="row_text">
		<span class="col_text_1">
			<?php echo JText::_('COM_CONTACT_FRIDAY'); ?>
		</span>
		<span class="col_text_2">
			<?php echo $this->contact->friday; ?>
		</span>
	</div>
				
	<div class="row_text">
		<span class="col_text_1">
			<?php echo JText::_('COM_CONTACT_SATURDAY'); ?>
		</span>
		<span class="col_text_2">
			<?php echo $this->contact->saturday; ?>
		</span>
	</div>
					
	<div class="row_text">
		<span class="col_text_1">
			<?php echo JText::_('COM_CONTACT_SUNDAY'); ?>
		</span>
		<span class="col_text_2 col_text_sundayhours">
			<?php echo $this->contact->sunday; ?>
		</span>
	</div>
	
</div>

	<?php endif; ?>

<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>" itemprop="email">
			<?php echo nl2br($this->params->get('marker_email')); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-emailto">
			<?php echo $this->contact->email_to; ?>
		</span>
	</dd>
<?php endif; ?>

<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_telephone'); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-telephone" itemprop="telephone">
			<?php echo nl2br($this->contact->telephone); ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>">
			<?php echo $this->params->get('marker_fax'); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-fax" itemprop="faxNumber">
		<?php echo nl2br($this->contact->fax); ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_mobile'); ?>
		</span>
	</dt>
	<dd>
		<span class="contact-mobile" itemprop="telephone">
			<?php echo nl2br($this->contact->mobile); ?>
		</span>
	</dd>
<?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<dt>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
		</span>
	</dt>
	<dd>
		<span class="contact-webpage">
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank" itemprop="url">
			<?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
		</span>
	</dd>
<?php endif; ?>
</dl>
<!--<div id="contact-sgr-logo"><img src="images/icons/sgr.png"/></div> -->
</div>
