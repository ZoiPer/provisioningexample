# provisioningexample
Zoiper provisioning server example
**************************
Copyrights (c) Zoiper 2016
**************************
Zoiper XML provisioning 
This automatic configuration can be done by using an HTTP/S server. 
Once an end-user launches the application a pop-up window will appear to ask the end-user to enter his username and password. 
After the end-user fills in the username and password and clicks on "Ok" an HTTP/s Get request will be sent to the provisioning server. 

https://www.example.com/id.php?username=[user]&password=[pass]&version=[version] 

username=[user]  -  the provisioning username
password=[password]  -  the provisioning password
version=[version]  -  the provisioning version 

The server should reply with account configuration in XML format. An example XML looks like this: 

```
<options>
	<!--
		Possible values: string

		Version of the provisioning XML
	-->
	<prov_version>1.14</prov_version>

	<!--
		Possible values: string

		Optional unique customer ID
	-->
	<customer_sid>855</customer_sid>

	<!--
		Possible values: string

		Optional unique provisioning ID
	-->
	<prov_id>da98ea5f6dad4bd0d9f98e087d1d9151</prov_id>

	<!--
		Possible values: string

		Optional name of the provisioning something something.
	-->
	<prov_name>test555</prov_name>

	<!--
		Accounts holds account nodes for each provisioned account.
		Only one per provisioning XML.
	-->
	<accounts>

		<!--
			Account contains a complete account configuration.
		-->
		<account>

			<!--
				Possible values: string

				Identifier of the account unique and not changeable.
			-->
			<ident></ident>

			<!--
				Possible values: string

				Account display name.
			-->
			<name></name>

			<!--
				Possible values: string

				Username.
			-->
			<username></username>

			<!--
				Possible values: string

				Password.
			-->
			<password></password>

			<!--
				Possible values: true, false

				Controls startup registration of the account.
			-->
			<register_on_startup>true</register_on_startup>

			<!--
				Possible values: true, false

				Controls the use of push notifications.
			-->
			<enable_push_notifications>true</enable_push_notifications>

			<!--
				Possible values: true, false

				Optional enables ring-back tones
			-->
			<do_not_play_ringback_tones>true</do_not_play_ringback_tones>

			<!--
				Possible values: string

				Optional voice mail extension.
			-->
			<voicemail_check_extension></voicemail_check_extension>

			<!--
				Possible values: string

				Optional voice mail transfer extension.
			-->
			<voicemail_transfer_extension></voicemail_transfer_extension>

			<!--
				Possible values: true, false

				Optional forces rfc3264.
			-->
			<force_rfc3264>true</force_rfc3264>

			<!--
				Possible values: true, false

				Optional enables KPML.
			-->
			<use_kpml>true</use_kpml>

			<!--
				Possible values: true, false

				Optional enables overlap dialing.
			-->
			<use_overlap_dialing>true</use_overlap_dialing>

			<!--
				Possible values: true, false

				Optional enables custom ringtone.
			-->
			<use_custom_ringtone>true</use_custom_ringtone>

			<!--
				Possible values: string

				Optional custom ring-tone uri.
			-->
			<custom_ringtone_location></custom_ringtone_location>

 			<!--
				Possible values: none, common, location, configuration, self_signed

				Optional custom certificate usage ...
			-->
			<use_custom_certificate></use_custom_certificate>

			<!--
				Possible values: string

				Optional custom certificate uri.
			-->
			<custom_certicate_location></custom_certicate_location>

			<!--
				Possible values: string

				Optional custom certificate data.
			-->
			<custom_certificate></custom_certificate>

 			<!--
				Possible values: disabled, before, after, both

				Optional message waiting indication subscription ...
			-->
			<mwi_subscribe_usage></mwi_subscribe_usage>

			<!--
				Possible values: true, false

				Optional enables number rewriting.
			-->
			<use_number_rewriting>true</use_number_rewriting>

			<!--
				Possible values: string, auto-detect

				Optional specifies country code to be applied to numbers without such.
			-->
			<number_rewriting_country></number_rewriting_country>

			<!--
				Possible values: string

				Optional enables number rewriting with custom dialout prefix.
			-->
			<number_rewriting_prefix></number_rewriting_prefix>

			<!--
				Possible values: true, false

				Optional enables the striping of characters from the dial string.
			-->
			<use_strip_dial_chars>true</use_strip_dial_chars>

			<!--
				Possible values: string

				Optional the characters that are gooing to be stripped from the dial string.
			-->
			<strip_dial_chars> .-()[]{}</strip_dial_chars>

			<!--
				Possible values: string

				Optional
			-->
			<token></token>

			<!--
				Possible values: string

				Optional
			-->
			<token_url>https://google.com/provision?token=</token_url>

			<!--
				Possible values: string

				Optional
			-->
			<balance_url>https://example.com/script.php?username=${USERNAME}&amp;password=${PASSWORD}&amp;currency=${CURRENCY}</balance_url>

			<!--
				Possible values: string

				Optional
			-->
			<rate_url>https://example.com/script.php?destination=${DESTINATION}&amp;currency=${CURRENCY}&amp;username=${USERNAME}&amp;password=${PASSWORD}</rate_url>

			<!--
				Possible values: string

				Optional
			-->
			<quality_rating_url>https://example.com/script.php?id=${CALL_IDENTIFIER}&amp;rating=${RATING}</quality_rating_url>

			<!--
				Possible values: SIP, IAX2, XMPP, RTSP

				Protocol. Controls the presence of configuration
				blocks: SIP, IAX2
			-->
			<protocol>SIP</protocol>

			<!--
				Possible values: default, custom

				The default registration refresh should be 600s for TCP and 30s for UDP.
				Note that the server might enforce different (shorter) refresh time.  The stack
				will not wait for the full period to refresh the registration.  It will
				try to refresh it after 90% of the negotiated time has elapsed.
			-->
			<reregistration_mode>default</reregistration_mode>

			<!--
				Possible values: unsigned long

				Use this to specify the reregistration time when the mode selected is custom.
			-->
			<reregistration_time>600</reregistration_time>

			<!--
				Possible values: default, custom

				The default subscription refresh should be 1800s for TCP and UDP.
			-->
			<resubscription_mode>default</resubscription_mode>

			<!--
				Possible values: unsigned long

				Optional
			-->
			<resubscription_time>1800</resubscription_time>

			<!--
				Possible values: string

				Configures the user domain.
			-->
			<SIP_domain></SIP_domain>

			<!--
				Possible values: true, false

				Optional use outbound proxy.
			-->
			<SIP_use_outbound_proxy>true</SIP_use_outbound_proxy>

			<!--
				Possible values: string

				Optional SIP proxy server to force
				instead of the automatically detected one.
			-->
			<SIP_outbound_proxy></SIP_outbound_proxy>

			<!--
				Possible values: UDP, TCP, TLS

				The signalling protocol.
			-->
			<SIP_transport_type>UDP</SIP_transport_type>

			<!--
				Possible values: true, false

				Optional use authentication username.
			-->
			<SIP_use_auth_username>true</SIP_use_auth_username>

			<!--
				Possible values: string

				Optional user name to be used
				when responding to a SIP authentication challenge.
			-->
			<SIP_auth_username></SIP_auth_username>

			<!--
				Possible values: string

				Optional the display name.
			-->
			<SIP_callerId></SIP_callerId>

			<!--
				Possible values: true, false

				This function can be used to discover the public address and port in case
				there is a NAT between the user and the server.  It also helps for normal
				unfirewalled TCP and TLS connections (highly recommended for these two
				protocols).

				If rport is enabled for UDP connects along with STUN, STUN will be preferred.

				The default is to have rport disabled for UDP.  To enable rport, call this
				function before RegisterUser().  A registration must be done to do a full
				discovery before making any calls if they are to benefit from rport.
			-->
			<SIP_use_rport>false</SIP_use_rport>

			<!--
				Possible values: true, false

				Enables usage of rport discovered public address for media negotiations.
				Can help in some firewall/NAT/VPN setups where the port is not changed,
				only the private address is replaced with a public one.  When both rport
				and STUN are enabled, STUN will be preferred.

				This option is not recommended.  Enable it only if you absolutely know
				what you're doing.
			-->
			<SIP_use_rport_media>false</SIP_use_rport_media>

			<!--
				Possible values: none, SDES

				Select the user's SRTP mode.
			-->
			<SIP_srtp_mode>none</SIP_srtp_mode>

			<!--
				Possible values: inband, rfc_2833, SIP_info_numeric, SIP_info_ascii, disbaled

				Select the DTMF band for the user.
			-->
			<SIP_dtmf_style>0</SIP_dtmf_style>

			<!--
				Possible values: true, false

				Optional enable busy line feed.
			-->
			<SIP_use_blf>true</SIP_use_blf>

			<!--
				Possible values: true, false

				Optional publish user presence.
			-->
			<SIP_publish_presence>true</SIP_publish_presence>

			<!--
				Possible values: true, false

				Optional subscribe for other users presence.
			-->
			<SIP_subscribe_presence>true</SIP_subscribe_presence>

			<!--
				Possible values: disabled, default, custom

				Optional
			-->
			<SIP_keep_alive_mode>disabled</SIP_keep_alive_mode>

			<!--
				Possible values: unsigned long

				Optional
			-->
			<SIP_keep_alive_timeout>90</SIP_keep_alive_timeout>
			
			<!--
				Possible values: true, false

				Optional enable preconditions.
			-->
			<SIP_use_preconditions>false</SIP_use_preconditions>
			
			<!--
				Possible values: true, false

				Optional enable reg events.
			-->
			<SIP_use_reg_event>false</SIP_use_reg_event>

			<!--
				Possible values: string

				The Jabber Id of the user
			-->
      <XMPP_JId>cabob@server.com</XMPP_JId>

			<!--
				Possible values: string

				Optional full name of the XMPP user
			-->
      <XMPP_name>Alexander Savov</XMPP_name>

			<!--
				Possible values: string

				Optional XMPP connect server
			-->
      <XMPP_server>server.com</XMPP_server>

			<!--
				Possible values: true, false

				It governs the usage of the legacy TLS mode for XMPP
			-->
      <XMPP_legacy_tls>false</XMPP_legacy_tls>

			<!--
				stun holds stun related settings.
			-->
			<stun>

				<!--
					Possible values: disabled, custom, default

					In most cases only disabled and custom are used

					Controls the use of STUN.
				-->
				<use_stun>custom</use_stun>

				<!--
					Possible values: string

					Configures the address of the STUN server.
				-->
				<stun_host>goolge.com</stun_host>

				<!--
					Possible values: unsigned int

					Configures the port of the STUN server.
				-->
				<stun_port>3478</stun_port>

				<!--
					Possible values: unsigned int

					Sets the refresh period of the STUN server
					Use this function to specify how often to refresh the STUN server.
					The default is 30 seconds.  The refresh can be used to keep the NAT mapping alive.
				-->
				<stun_refresh_period>40</stun_refresh_period>

			</stun>
			<!--
				Possible values: string

				Configures the server address.
			-->
			<IAX2_host></IAX2_host>

			<!--
				Possible values: string

				Configures the context to be used.
			-->
			<IAX2_context></IAX2_context>

			<!--
				Possible values: string

				Optional the display name.
			-->
			<IAX2_callerId></IAX2_callerId>

			<!--
				Possible values: string

				Configures the user name used for identification.
			-->
			<IAX2_callerNumber></IAX2_callerNumber>

			<!--
				Possible values: inband, disabled, outband

				Select the DTMF band for the user.
			-->
			<IAX2_dtmf_style>0</IAX2_dtmf_style>

			<!--
				Possible values: true, false

				Enable file transfer for the user.
			-->
			<enable_file_transfer></enable_file_transfer>
			
			<!--
				Possible values: true, false

				Enable video fmtp for the user.
			-->
			<enabled_video_fmtp></enabled_video_fmtp>
			
			<!--
				msrp holds msrp related settings.
			-->
			<msrp>

				<!--
					Possible values: true, false

					Enable msrp for the user.
				-->
				<enabled></enabled>

				<!--
					Possible values: true, false

					Force user to use msrp for chat messages.
				-->
				<force_msrp_for_chat></force_msrp_for_chat>

				<!--
					Possible values: true, false

					Enables TLS for the MSRP.
				-->
				<enable_tls></enable_tls>

				<!--
					Possible values: true, false

					Enable msrp relay for the user.
				-->
				<enable_relay></enable_relay>

				<!--
					Possible values: string

					MSRP relay uri.
				-->
				<relay_uri></relay_uri>

				<!--
					Possible values: string

					MSRP relay username.
				-->
				<relay_username></relay_username>

				<!--
					Possible values: string

					Msrp relay password.
				-->
				<relay_password></relay_password>
			</msrp>
			
			<!--
				sms holds sms related settings.
			-->
			<sms>

				<!--
					Possible values: true, false

					Enable SMS for the user.
				-->
				<enabled></enabled>
				
				<!--
					Possible values: true, false

					Enable SMS center for the user.
				-->
				<enable_sms_center></enable_sms_center>
				
				
				<!--
					Possible values: string

					SMS center uri.
				-->
				<sms_center_uri></sms_center_uri>
			</sms>	

			<!--
				codecs holds codec nodes for each supported codec for that.
				Only one per provisioning xml.
			-->
			<codecs>

				<!--
					codec contains a codec id, name, priority and if it's enabled.
				-->
				<codec>

					<!--
						Possible values: unsigned int

						Internal codec id
						Current list:
							0	-	uLaw
							1	-	GSM
							6	-	aLaw
							7	-	g722
							16	-	g729
							24	-	Speex
							25	-	Speex wide
							26	-	Speex ultra
							27	-	iLBC30
							29	-	g726
							30	-	H263 Plus
							31	-	VP8
							34	-	Opus narrow
							35	-	Opus wide
							36	-	Opus super
							37	-	Opus full
					-->
					<codec_id>27</codec_id>

					<!--
						Possible values: unsigned int

						Codec priority in media negotiations.
					-->
					<priority>1</priority>

					<!--
						Possible values: true, false

						Controls if the codec is enabled
					-->
					<enabled>true</enabled>

					<!--
						Possible values: long

						Optional
					-->
					<bps>0</bps>

					<!--
						Possible values: long

						Optional
					-->
					<dtx>0</dtx>

					<!--
						Possible values: long

						Optional
					-->
					<vbr>0</vbr>

				</codec>

			</codecs>
			
			<!--
				zrtp holds zrtp related settings.
			-->
			<zrtp>
				<!--
					Possible values: true, false

					Enables ZRTP
				-->
				<enabled>false</enabled>
				
				<hash_algorithms>
				  <hash_algorithm>
					<!--
						Possible values: S256, S384

						Hash algorithm name 
					-->

					<name>S256</name>
					
					<!--
						Possible values:
							0 - S256
							1 - S384
						Hash algorithm id 
					-->
					<id>0</id>
					
					<!--
						Possible values: int

						Hash algorithm priority
					-->			
					<priority>0</priority>
					<!--
						Possible values: true, false

						Controls if the hash algorithm is enabled
					-->
					<selected>true</selected>
				  </hash_algorithm>
				</hash_algorithms>
				
				<cipher_algorithms>
				  <cipher_algorithm>
					<!--
						Possible values: AES51,

						Cipher algorithm name 
					-->		  
					<name>AES51</name>
					<!--
						Possible values:
							0 - AES51
						Cipher algorithm id 
					-->			
					<id>0</id>
					<!--
						Possible values: int

						Cipher algorithm priority
					-->						
					<priority>0</priority>
					<!--
						Possible values: true, false

						Controls if the cipher algorithm is enabled
					-->			
					<selected>true</selected>
				  </cipher_algorithm>
				</cipher_algorithms>
				
				<auth_tags>
				  <auth_tag>
					<!--
						Possible values: HS32, HS80

						Auth tags name 
					-->		
					<name>HS80</name>
					<!--
						Possible values:
							0 - HS32
							1 - HS80
						Auth tags  id 
					-->		
					<id>1</id>
					<!--
						Possible values: int

						Auth tags  priority
					-->	
					<priority>1</priority>
					<!--
						Possible values: true, false

						Controls if the Auth tags  is enabled
					-->						
					<selected>true</selected>
				  </auth_tag>
				</auth_tags>
				
				<key_agreement_methods>
				  <key_agreement>
					<!--
						Possible values: DH2K, EC25, DH3K, EC38

						Key agreement name 
					-->		
					<name>DH2K</name>
					<!--
						Possible values:
							0 - DH2K
							1 - EC25
							2 - DH3K
							3 - EC38
						Key agreement  id 
					-->		
					<id>1</id>
					<!--
						Possible values: int

						Key agreement priority
					-->	
					<priority>0</priority>
					<!--
						Possible values: true, false

						Controls if the Key agreement is enabled
					-->				
					<selected>true</selected>
				  </key_agreement>
				</key_agreement_methods>
				
				<sas_encodings>
				  <sas_encoding>
					<!--
						Possible values: B256, B32

						Sas encodings name 
					-->		
					<name>B256</name>
								<!--
						Possible values:
							0 - B32
							1 - B256
						Sas encodings  id 
					-->	
					<id>1</id>
								<!--
						Possible values: int

						Sas encodings priority
					-->	
					<priority>0</priority>
								<!--
						Possible values: true, false

						Controls if the SAS encodings is enabled
					-->	
					<selected>true</selected>
				  </sas_encoding>
				</sas_encodings>
			</zrtp>
			
		</account>

	</accounts>

	<!--
		diagnostics holds diagnostics related settings.
	-->
	<diagnostics>
		<!--
			Possible values: true, false

			Optional enables the debug logging into a file
		-->
		<enable_debug_log>false</enable_debug_log>

		<!--
			Possible values: true, false

			Optional enables the extended crash dump file. Available only on Windows.
		-->
		<enable_extra_dmp>false</enable_extra_dmp>

		<!--
			Possible values: true, false

			Optional enables the audio log files.
		-->
		<enable_audio_debug>false</enable_audio_debug>

	</diagnostics>
	
	<!--
		Breakpad holds breakpad related settings.
	-->	
	<breakpad>
		<!--
			Possible values: true, false

			Optional enables breakpad
		-->
		<enabled>true</enabled>
		<!--
			Possible values: true, false

			Optional enables automatic breakpad dumps sending 
		-->		
		<upload_dumps>true</upload_dumps>
		<!--
			Possible values: true, false

			Optional enables “ask user for breakpad” dumps sending 
		-->		
		<ask_user_for_upload>true</ask_user_for_upload>
  </breakpad>

</options>
```
**************************
Copyrights (c) Zoiper 2016
**************************
